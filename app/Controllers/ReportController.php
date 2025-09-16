<?php

namespace App\Controllers;

use App\Core\View;
use App\Middleware\RouteMiddleware;

class ReportController
{
    public function __construct()
    {
        RouteMiddleware::requireAuth();
    }
    public function index()
    {
        View::render('reports.main_report_view', [
            'title' => 'Report',
        ]);
    }
}
