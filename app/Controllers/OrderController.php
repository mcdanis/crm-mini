<?php

namespace App\Controllers;

use App\Core\View;

class OrderController
{
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
