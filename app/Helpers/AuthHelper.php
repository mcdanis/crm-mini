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

        // Validasi format token
        if (!preg_match('/^[a-f0-9]{32}$/', $token)) {
            return false;
        }

        // Cari user berdasarkan token
        $user = User::where('token', $token)->first();
        
        if (!$user) {
            return false;
        }

        // Cek apakah token masih berlaku
        if ($user->token_expire_at && strtotime($user->token_expire_at) < time()) {
            // Token expired, hapus dari database
            $user->update([
                'token' => null,
                'token_expire_at' => null
            ]);
            return false;
        }

        return true;
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

        $user = User::where('token', $_COOKIE['login_token'])->first();
        return $user ? $user->id : null;
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

        $user = User::where('token', $_COOKIE['login_token'])->first();
        return $user ? $user->toArray() : null;
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