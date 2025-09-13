<?php
namespace App\Controllers;

use App\Core\View;

class ServiceController {
    public function add() {
        View::render('services.service_add_view', [
            'title' => 'Customer List',
        ]);
    }
    
    public function index() {
        View::render('services.service_list_view', [
            'title' => 'Customer List',
        ]);
    }
}
 
