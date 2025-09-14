<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\ResponseHelper;
use App\Middleware\RouteMiddleware;
use App\Models\Setting;
use App\Models\User;

class SettingController
{
    public function __construct()
    {
        RouteMiddleware::requireAuth();
    }

    public function index()
    {
        $stats = User::selectRaw("
            COUNT(*) as total_users,
            SUM(CASE WHEN is_active = 1 THEN 1 ELSE 0 END) as active_users,
            SUM(CASE WHEN is_active = 0 THEN 1 ELSE 0 END) as inactive_users,
            SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) as admin_users,
            SUM(CASE WHEN role = 'user' THEN 1 ELSE 0 END) as normal_users
        ")->first();

        $users = User::select('id', 'email', 'full_name', 'role', 'is_active', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get();

        View::render('setting.setting_view', [
            'title' => 'Setting your application',
            'setting' => Setting::first(),
            'stats' => $stats,
            'users' => $users
        ]);
    }

    public function updateSetting()
    {
        try {
            Setting::first()->update([
                'language' => $_POST['language'],
                'currency' => $_POST['currency'],
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            echo ResponseHelper::success('General settings updated!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
