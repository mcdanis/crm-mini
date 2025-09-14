<?php

namespace App\Helpers;

use App\Models\User;

class ValidationHelper
{
    /**
     * Validasi email format
     */
    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validasi panjang string (min & max)
     */
    public static function stringLength(string $value, int $min = 1, int $max = 255): bool
    {
        $len = strlen($value);
        return $len >= $min && $len <= $max;
    }

    /**
     * Validasi angka saja
     */
    public static function numeric(string $value): bool
    {
        return is_numeric($value);
    }

    /**
     * Validasi hanya huruf
     */
    public static function alpha(string $value): bool
    {
        return ctype_alpha($value);
    }

    /**
     * Validasi alfanumerik
     */
    public static function alphaNum(string $value): bool
    {
        return ctype_alnum($value);
    }

    /**
     * Validasi password (panjang min 8, ada huruf & angka)
     */
    public static function password(string $password): bool
    {
        return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password) === 1;
    }

    /**
     * Validasi apakah email sudah terpakai
     */
    public static function uniqueEmail(string $email): bool
    {
        return !User::where('email', $email)->exists();
    }

    /**
     * Validasi apakah user aktif
     */
    public static function isUserActive(int $userId): bool
    {
        return User::where('id', $userId)->where('is_active', 1)->exists();
    }
}


// use App\Helpers\ValidationHelper;

// if (!ValidationHelper::email($request->email)) {
//     return ResponseHelper::failed('Invalid email format');
// }

// if (!ValidationHelper::uniqueEmail($request->email)) {
//     return ResponseHelper::failed('Email already in use');
// }

// if (!ValidationHelper::password($request->password)) {
//     return ResponseHelper::failed('Password must be at least 8 chars, contain letters and numbers');
// }
