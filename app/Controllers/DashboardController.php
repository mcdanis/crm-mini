<?php
namespace App\Controllers;

use App\Core\View;
use App\Middleware\RouteMiddleware;

class DashboardController {
    public function __construct(){
        RouteMiddleware::requireAuth();
    }
    public function index() {
        $user = ['id' => 1, 'name' => 'Dani']; //
        View::render('dashboard.home_view', [
            'title' => 'Halaman Home',
            'user'  => $user
        ]);
    }
}
