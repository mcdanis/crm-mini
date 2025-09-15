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
        // Hanya huruf + spasi
        return (bool) preg_match('/^[a-zA-Z\s]+$/', $value);
    }


    /**
     * Validasi alfanumerik
     */
    public static function alphaNum(string $value): bool
    {
        return preg_match('/^[a-zA-Z0-9 ]+$/', $value) === 1;
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

    public static function required(array $data, array $fields): array
    {
        $errors = [];

        foreach ($fields as $field) {
            $value = $data[$field] ?? null;

            if ($value === null || trim($value) === '') {
                $errors[] = ucfirst(self::humanize($field)) . " is required.";
            }
        }

        return $errors;
    }

    /**
     * Convert field name to human readable string
     * e.g. nameVar -> "name var", name_var -> "name var"
     */
    private static function humanize(string $field): string
    {
        // ubah snake_case ke spasi
        $field = str_replace('_', ' ', $field);

        // ubah camelCase ke spasi
        $field = preg_replace('/([a-z])([A-Z])/', '$1 $2', $field);

        return strtolower($field);
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
