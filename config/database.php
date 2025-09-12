<?php

use Illuminate\Database\Capsule\Manager as Capsule;

return function (): Capsule {
	$capsule = new Capsule();

	// detect is this run in docker or not
	$inContainer = file_exists('/.dockerenv')
		|| (getenv('APP_IN_CONTAINER') === 'true')
		|| (getenv('DOCKER') === 'true');

	$defaultHost = $inContainer ? 'db' : '127.0.0.1';
	$defaultPort = $inContainer ? '3306' : '3337';

	$dbHost = getenv('DB_HOST') ?: $defaultHost;
	$dbPort = getenv('DB_PORT') ?: $defaultPort;
	$dbName = getenv('DB_DATABASE') ?: 'crm_app';
	$dbUser = getenv('DB_USERNAME') ?: 'crm_user';
	$dbPass = getenv('DB_PASSWORD') ?: 'crm_pass';

	$capsule->addConnection([
		'driver' => 'mysql',
		'host' => $dbHost,
		'port' => $dbPort,
		'database' => $dbName,
		'username' => $dbUser,
		'password' => $dbPass,
		'charset' => 'utf8mb4',
		'collation' => 'utf8mb4_unicode_ci',
		'prefix' => '',
	]);

	$capsule->setAsGlobal();
	$capsule->bootEloquent();

	return $capsule;
}; 
