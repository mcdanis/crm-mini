<?php

namespace App\Controllers;

use App\Core\View;

class UserController
{
    
    public function index()
    {
        View::render('user.user_profile_view', [
            'title' => 'Your Profile',
        ]);
    }
}
