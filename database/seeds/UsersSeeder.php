<?php
require __DIR__ . '/../../config/app.php';

use App\Models\User;

$user = User::create(
  [
    'email' => 'admin2@gmail.com',
    'full_name' => 'Admin2',
    'password_hash' => md5('admin'),
    'role' => 'admin',
    'is_active' => 1,
  ]
);

echo json_encode($user) . PHP_EOL;