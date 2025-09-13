<?php

namespace App\Controllers;

use App\Core\View;

class CustomerController
{
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
}
