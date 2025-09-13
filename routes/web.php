<?php

use App\Models\User;

$router->get('', 'DashboardController@index');
$router->get('order/create', function () {
    echo "Form buat Order";
});

$router->get('profile/{id}', function ($id) {
    $user = User::find($id);
    echo $user ? json_encode($user) : "User tidak ditemukan";
});
