<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\User;
use App\Helpers\UtilHelper;

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
        $user = User::where($column, $_COOKIE['login_token'])->first();
        return $user;
    }

    public function updateProfile()
    {
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
}
