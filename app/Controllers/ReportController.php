<?php

namespace App\Controllers;

use App\Core\View;

class ReportController
{
    public function index()
    {
        View::render('reports.main_report_view', [
            'title' => 'Report',
        ]);
    }
}
