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
}
