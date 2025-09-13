<?php

namespace App\Controllers;

use App\Core\View;

class AuthController
{

    public function index()
    {
        View::render('auth.login', [
            'title' => 'Customer List',
        ]);
    }

    public function forgotPassword()
    {
        View::render('auth.forgot', [
            'title' => 'Forgot Password',
        ]);
    }
}
