<?php

namespace App\Controllers;

use App\Core\View;
use App\Middleware\RouteMiddleware;

class CustomerController
{
    public function __construct()
    {
        RouteMiddleware::requireAuth();
    }
    public function add()
    {
        View::render('customers.customer_add_view', [
            'title' => 'Customer List',
        ]);
    }

    public function index()
    {
        View::render('customers.customer_list_view', [
            'title' => 'Customer List',
        ]);
    }

    public function detail()
    {
        View::render('customers.customer_detail_view', [
            'title' => 'Detail Customer of ',
        ]);
    }
}
