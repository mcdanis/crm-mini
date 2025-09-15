<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public static function currency()
    {
        return Setting::select('currency')->first()->currency ?? 'USD';
    }
}
