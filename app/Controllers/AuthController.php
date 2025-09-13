<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\AuthHelper;

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

    public function login() 
    {
        // TODO: Implementasi login dengan cookie
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