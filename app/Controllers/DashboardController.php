<?php
namespace App\Controllers;

use App\Core\View;

class DashboardController {
    public function index() {
        $user = ['id' => 1, 'name' => 'Dani']; //
        View::render('dashboard.home_view', [
            'title' => 'Halaman Home',
            'user'  => $user
        ]);
    }
}
