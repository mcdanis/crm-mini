<?php

/**
 * Simple application bootstrap to initialize Eloquent Capsule
 */

// Load Composer autoload
$autoloadPaths = [
	__DIR__ . '/vendor/autoload.php',
	__DIR__ . '/../vendor/autoload.php',
	__DIR__ . '/public/vendor/autoload.php',
];

$autoloadLoaded = false;
foreach ($autoloadPaths as $path) {
	if (file_exists($path)) {
		require_once $path;
		$autoloadLoaded = true;
		break;
	}
}

if (!$autoloadLoaded) {
	throw new RuntimeException('Composer autoload.php tidak ditemukan. Jalankan composer install.');
}

$initDatabase = require __DIR__ . '/database.php';
$capsule = $initDatabase();

return $capsule; 
