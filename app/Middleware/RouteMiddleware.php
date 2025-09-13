<?php

namespace App\Helpers;

class RouteMiddleware
{
    /**
     * Middleware untuk route yang memerlukan login
     * 
     * @return void
     */
    public static function requireAuth()
    {
        AuthHelper::requireLogin();
    }

    /**
     * Middleware untuk route yang hanya bisa diakses guest (belum login)
     * 
     * @return void
     */
    public static function requireGuest()
    {
        AuthHelper::redirectIfLoggedIn();
    }
}