<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/app.php';
require __DIR__ . '/app/Core/Router.php';

$router = new Router();

// load routes
require __DIR__ . '/routes/web.php';

// ambil URL dan method
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// dispatch ke route yang cocok
$router->dispatch($uri, $method);
