<?php
require __DIR__ . '/config/app.php';

use App\Models\User;

echo json_encode(User::all());