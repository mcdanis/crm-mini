<?php

namespace App\Controllers;

use App\Core\View;
use App\Middleware\RouteMiddleware;

class OrderController
{
    public function __construct()
    {
        RouteMiddleware::requireAuth();
    }
    public function add()
    {
        View::render('orders.order_add_view', [
            'title' => 'Customer List',
        ]);
    }

    public function index()
    {
        View::render('orders.order_list_view', [
            'title' => 'Customer List',
        ]);
    }
}
