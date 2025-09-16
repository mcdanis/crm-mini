<?php

namespace App\Helpers;

use App\Models\User;

class UtilHelper
{
    public static function redirectWithMessage($url, $type, $message)
    {
        $errorMessage = urlencode($message);
        header("Location: {$url}?{$type}={$errorMessage}");
        exit();
    }

    public function truncateString($text, $limit = 50, $suffix = '...')
    {
        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . $suffix;
        }
        return $text;
    }

    public static function getInitials(string $name, ?int $limit = null, bool $upper = true): string
    {
        // normalisasi: trim dan ganti banyak spasi dengan satu
        $name = trim(preg_replace('/\s+/u', ' ', $name));

        if ($name === '') {
            return '';
        }

        // split kata berdasarkan karakter non-alfanumerik (tetap menangani huruf unicode)
        $words = preg_split('/[^\p{L}\p{N}]+/u', $name, -1, PREG_SPLIT_NO_EMPTY);

        if (!$words) {
            return '';
        }

        // ambil awalan tiap kata (multi-byte safe)
        $initials = [];
        foreach ($words as $w) {
            $initials[] = mb_substr($w, 0, 1, 'UTF-8');
        }

        // jika dibatasi jumlah inisial, ambil yang pertama sesuai limit
        if (is_int($limit) && $limit > 0) {
            $initials = array_slice($initials, 0, $limit);
        }

        $result = implode('', $initials);

        return $upper ? mb_strtoupper($result, 'UTF-8') : mb_strtolower($result, 'UTF-8');
    }
}
