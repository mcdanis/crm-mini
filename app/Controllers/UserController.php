<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Helpers\UtilHelper;
use App\Helpers\HtmlGenerateHelper;
use App\Helpers\ResponseHelper;
use App\Helpers\ValidationHelper;

class UserController
{

    public function index()
    {
        $user = $this->getUser($_COOKIE['login_token']);
        View::render('user.user_profile_view', [
            'user' => $user,
            'title' => 'Your Profile'
        ]);
    }

    public function getUser($param, $column = 'token')
    {
        $user = User::where($column, $param)->first();
        return $user;
    }

    public function updateProfile()
    {
        try {

            if (!isset($_POST['user_id'])) {
                // Ambil user saat ini via login token
                $user = $this->getUser($_COOKIE['login_token']);

                // Update profile dasar
                $user->update([
                    'email'     => $_POST['email'],
                    'full_name' => $_POST['full_name'],
                ]);

                $message = 'Your profile has been updated!';

                // Cek role hanya jika field role dikirim
                if (isset($_POST['role'])) {
                    $checkAdmin = User::where('role', 'admin')->count();

                    // Jika ada lebih dari 1 admin, boleh update role
                    if ($checkAdmin > 1 || $user->role != 'admin') {
                        $user->update([
                            'role' => $_POST['role']
                        ]);
                    }

                    if ($user->role != $_POST['role']) {
                        // Hanya satu admin, role tidak boleh diubah
                        $message .= " Role can't be changed because you're the only Admin";
                    }
                }

                return UtilHelper::redirectWithMessage('/user/profile', 'success', $message);
            } else {
                $user = $this->getUser($_POST['user_id'], 'id')->update([
                    'email'     => $_POST['email'],
                    'full_name' => $_POST['full_name'],
                    'role' => $_POST['role'],
                    'is_active' => $_POST['status'],
                ]);
                return ResponseHelper::success('User profile updated!');
            }
        } catch (\Throwable $th) {
            return UtilHelper::redirectWithMessage('/user/profile', 'error', 'something went wrong!');
        }
    }

    public function updatePassword()
    {

        $user = $this->getUser($_COOKIE['login_token']);

        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword     = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        // 1. Validasi input kosong
        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            return UtilHelper::redirectWithMessage('/user/profile', 'danger', 'All password fields are required!');
        }

        // 2. Cek password lama
        if (md5($currentPassword) != $user->password_hash) {
            return UtilHelper::redirectWithMessage('/user/profile', 'danger', 'Current password is incorrect!');
        }


        // 3. Cek konfirmasi password
        if ($newPassword !== $confirmPassword) {
            return UtilHelper::redirectWithMessage('/user/profile', 'danger', 'New password and confirmation do not match!');
        }

        // 4. Update password (gunakan hash yang aman)
        $hashedPassword = md5($newPassword);

        $user->update([
            'password_hash' => $hashedPassword
        ]);

        return UtilHelper::redirectWithMessage('/user/profile', 'success', 'Your password has been updated successfully!');
    }

    public function filterUsers()
    {
        $filters = [
            'name'      => $_POST['name']   ?? null,
            'is_active' => $_POST['status'] ?? null,
            'role'      => $_POST['role']   ?? null,
        ];

        $query = User::query();

        $query->when(!empty($filters['role']), function ($q) use ($filters) {
            $q->where('role', $filters['role']);
        });

        $query->when($filters['is_active'] !== null && $filters['is_active'] !== '', function ($q) use ($filters) {
            $q->where('is_active', $filters['is_active']);
        });

        $query->when(!empty($filters['name']), function ($q) use ($filters) {
            $q->where('full_name', 'like', '%' . $filters['name'] . '%');
        });

        // jalankan query
        $users = $query->orderBy('created_at', 'desc')->get();

        $html = '';

        if ($users->isEmpty()) {
            $html = '<tr><td colspan="5" class="text-center">No users found</td></tr>';
        } else {
            foreach ($users as $user) {
                $badge = 'role-user';
                $roleTitle = 'User';
                if ($user->role === 'admin') {
                    $badge = 'role-admin';
                    $roleTitle = 'Admin';
                }

                $statusBadge = $user->is_active == 1
                    ? '<span class="badge bg-success">Active</span>'
                    : '<span class="badge bg-danger">Inactive</span>';

                $html .= HtmlGenerateHelper::renderUserRow($user);
            }
        }

        echo $html;
    }

    public function changeUserStatus($status, $id)
    {
        try {
            if (!ValidationHelper::numeric($id)) {
                echo ResponseHelper::failed('payload is not valid, try again later!');
                die;
            }
            $this->getUser($id, 'id')->update([
                'is_active' => $status
            ]);
            echo ResponseHelper::success('User has been deactivated!');
        } catch (\Throwable $th) {
            echo ResponseHelper::failed('User can not deactivated, try again later!' . $th->getMessage());
        }
    }

    public function create()
    {
        if (!ValidationHelper::email($_POST['email'])) {
            echo ResponseHelper::failed('Invalid Email!');
            die;
        }

        if (!ValidationHelper::alpha($_POST['full_name'])) {
            echo ResponseHelper::failed('Full name can only be alphabet!');
            die;
        }

        if (!ValidationHelper::uniqueEmail($_POST['email'])) {
            echo ResponseHelper::failed('Email already in use');
            die;
        }

        try {
            $randomString = random_int(1000000, 9999999);
            User::create([
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'role' => $_POST['role'],
                'is_active' => $_POST['status'],
                'password_hash' => md5($randomString)
            ]);

            echo ResponseHelper::success('User ' . $_POST['email'] . ' has been added!, the password <b>' . $randomString . '</b>. note it down and give it to the user. because the initial password will not appear again');
        } catch (\Throwable $th) {
            echo ResponseHelper::failed($th->getMessage());
        }
    }
}
