<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\AuthHelper;
use App\Helpers\ValidationHelper;
use App\Models\User;

class AuthController
{
    public function index()
    {
        // Redirect ke dashboard jika sudah login
        AuthHelper::redirectIfLoggedIn();
        
        View::render('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function forgotPassword()
    {
        View::render('auth.forgot', [
            'title' => 'Forgot Password',
        ]);
    }

    /**
     * Logic login dengan validasi dan cookie
     */
    public function login() 
    {
        // Cek apakah request method adalah POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectToLoginWithError('Method tidak diizinkan');
            return;
        }

        // Ambil data dari form
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validasi input
        $validation = $this->validateLoginInput($email, $password);
        if (!$validation['valid']) {
            $this->redirectToLoginWithError($validation['message']);
            return;
        }

        // Cari user berdasarkan email
        $user = User::where('email', $email)->first();

        // Validasi user
        if (!$user) {
            $this->redirectToLoginWithError('Email atau password salah');
            return;
        }

        // Cek apakah user aktif
        if (!$user->is_active) {
            $this->redirectToLoginWithError('Akun Anda telah dinonaktifkan');
            return;
        }

        // Verifikasi password
        if (!password_verify($password, $user->password_hash)) {
            $this->redirectToLoginWithError('Email atau password salah');
            return;
        }

        // Generate token untuk cookie
        $token = $this->generateLoginToken();
        $tokenExpire = date('Y-m-d H:i:s', strtotime('+7 days')); // Token berlaku 7 hari

        // Update token di database
        $user->update([
            'token' => $token,
            'token_expire_at' => $tokenExpire
        ]);

        // Set cookie
        $this->setLoginCookie($token, 7); // Cookie berlaku 7 hari

        // Redirect ke dashboard
        header('Location: /dashboard');
        exit();
    }

    /**
     * Validasi input login
     * 
     * @param string $email
     * @param string $password
     * @return array
     */
    private function validateLoginInput($email, $password)
    {
        // Validasi email
        if (empty($email)) {
            return [
                'valid' => false,
                'message' => 'Email harus diisi'
            ];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return [
                'valid' => false,
                'message' => 'Format email tidak valid'
            ];
        }

        // Validasi password
        if (empty($password)) {
            return [
                'valid' => false,
                'message' => 'Password harus diisi'
            ];
        }

        if (strlen($password) < 6) {
            return [
                'valid' => false,
                'message' => 'Password minimal 6 karakter'
            ];
        }

        return [
            'valid' => true,
            'message' => 'Valid'
        ];
    }

    /**
     * Generate token untuk login
     * 
     * @return string
     */
    private function generateLoginToken()
    {
        // Generate random token 32 karakter
        return bin2hex(random_bytes(16));
    }

    /**
     * Set cookie untuk login
     * 
     * @param string $token
     * @param int $days
     * @return void
     */
    private function setLoginCookie($token, $days)
    {
        $expire = time() + ($days * 24 * 60 * 60); // Convert days to seconds
        
        setcookie(
            'login_token',           // Nama cookie
            $token,                  // Value
            $expire,                 // Expire time
            '/',                     // Path
            '',                      // Domain
            false,                   // Secure (set true untuk HTTPS)
            true                     // HttpOnly (mencegah akses dari JavaScript)
        );
    }

    /**
     * Redirect ke halaman login dengan error message
     * 
     * @param string $message
     * @return void
     */
    private function redirectToLoginWithError($message)
    {
        // Simpan error message di session atau flash message
        // Untuk sementara, kita akan menggunakan URL parameter
        $errorMessage = urlencode($message);
        header("Location: /login?error={$errorMessage}");
        exit();
    }

    /**
     * Logout user
     */
    public function logout()
    {
        // Hapus token dari database jika user sedang login
        if (AuthHelper::isLoggedIn()) {
            $user = User::where('token', $_COOKIE['login_token'])->first();
            if ($user) {
                $user->update([
                    'token' => null,
                    'token_expire_at' => null
                ]);
            }
        }

        // Hapus cookie
        setcookie('login_token', '', time() - 3600, '/');
        
        // Redirect ke halaman login
        header('Location: /login');
        exit();
    }

    /**
     * Access checker - dipanggil ketika pertama kali mengakses web
     */
    public function accessChecker()
    {
        // Periksa apakah user sudah login
        if (AuthHelper::isLoggedIn()) {
            // Jika sudah login, redirect ke dashboard
            header('Location: /dashboard');
            exit();
        } else {
            // Jika belum login, redirect ke halaman login
            header('Location: /login');
            exit();
        }
    }
}