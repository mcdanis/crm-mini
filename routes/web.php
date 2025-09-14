<?php

use App\Models\User;
use App\Controllers\ServiceController;

$router->get('', 'AuthController@accessChecker');

$router->get('login', 'AuthController@index');
$router->post('login', 'AuthController@login');
$router->get('logout', 'AuthController@logout');
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
$router->get('service/edit/{id}', 'ServiceController@editService');

// orderss
$router->get('order/add', 'OrderController@add');
$router->get('order/list', 'OrderController@index');

// report
$router->get('report', 'ReportController@index');

// setting
$router->get('settings', 'SettingController@index');

// user
$router->get('user/profile', 'UserController@index');

// API User
$router->post('api/user/create', 'UserController@create');
$router->post('api/user/profile/update', 'UserController@updateProfile');
$router->post('api/user/profile-password/update', 'UserController@updatePassword');
$router->post('api/user/filters', 'UserController@filterUsers');
$router->get('api/user/{status}/{id}', 'UserController@changeUserStatus');

// API setting
$router->post('api/setting/update', 'SettingController@updateSetting');

// API Service
$router->post('api/service/create', 'ServiceController@createService');
$router->post('api/service/update/{id}', 'ServiceController@updateService');
$router->get('api/service/delete/{id}', function ($id) {
    (new ServiceController)->deleteService($id);
});


// 

$router->get('profile/{id}', function ($id) {
    $user = User::find($id);
    echo $user ? json_encode($user) : "User tidak ditemukan";
});
