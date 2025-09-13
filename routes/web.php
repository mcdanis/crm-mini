<?php

use App\Models\User;

$router->get('', 'AuthController@accessChecker');

$router->get('login', 'AuthController@index');
$router->get('forgot-password', 'AuthController@forgotPassword');

// dashboard
$router->get('dashboard', 'DashboardController@index');

// customer
$router->get('customer/add', 'CustomerController@add');
$router->get('customer/list', 'CustomerController@index');
$router->get('customer/detail', 'CustomerController@detail');

// service
$router->get('service/add', 'ServiceController@add');
$router->get('service/list', 'ServiceController@index');

// orderss
$router->get('order/add', 'OrderController@add');
$router->get('order/list', 'OrderController@index');

// report
$router->get('report', 'ReportController@index');

$router->get('order/create', function () {
    echo "Form buat Order";
});

$router->get('profile/{id}', function ($id) {
    $user = User::find($id);
    echo $user ? json_encode($user) : "User tidak ditemukan";
});
