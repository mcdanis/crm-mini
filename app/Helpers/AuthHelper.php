<?php

namespace App\Helpers;

use App\Models\User;

class AuthHelper
{
    /**
     * Memeriksa apakah user sudah login berdasarkan cookie
     * 
     * @return bool
     */
    public static function isLoggedIn()
    {
        // Periksa apakah cookie login_token ada
        if (!isset($_COOKIE['login_token'])) {
            return false;
        }

        $token = $_COOKIE['login_token'];
        
        // Validasi token tidak kosong
        if (empty($token)) {
            return false;
        }

        // Validasi format token (bisa disesuaikan dengan format yang Anda gunakan)
        if (!preg_match('/^[a-zA-Z0-9]{32,}$/', $token)) {
            return false;
        }

        $user = User::where('token', $token)->first();
        return $user !== null;

        return true; // Sementara return true jika token ada dan valid format
    }

    /**
     * Mendapatkan user ID dari cookie
     * 
     * @return int|null
     */
    public static function getUserId()
    {
        if (!self::isLoggedIn()) {
            return null;
        }

        // TODO: Ambil user ID dari database berdasarkan token
        // $user = User::where('login_token', $_COOKIE['login_token'])->first();
        // return $user ? $user->id : null;

        return 1; // Sementara return 1
    }

    /**
     * Mendapatkan data user yang sedang login
     * 
     * @return array|null
     */
    public static function getCurrentUser()
    {
        if (!self::isLoggedIn()) {
            return null;
        }

        // TODO: Ambil data user dari database
        // $user = User::where('login_token', $_COOKIE['login_token'])->first();
        // return $user ? $user->toArray() : null;

        return [
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@example.com'
        ]; // Sementara return data dummy
    }

    /**
     * Redirect ke halaman login jika belum login
     * 
     * @return void
     */
    public static function requireLogin()
    {
        if (!self::isLoggedIn()) {
            header('Location: /login');
            exit();
        }
    }

    /**
     * Redirect ke dashboard jika sudah login
     * 
     * @return void
     */
    public static function redirectIfLoggedIn()
    {
        if (self::isLoggedIn()) {
            header('Location: /dashboard');
            exit();
        }
    }
}