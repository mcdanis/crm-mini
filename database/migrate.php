<?php

// Bootstrap app and database
require __DIR__ . '/../config/app.php';

$dir = __DIR__ . '/migrations';
$direction = $argv[1] ?? 'up'; // up or down
$filter = $argv[2] ?? null; // optional: specific file or substring

$files = glob($dir . '/*.php');
sort($files);

if ($filter) {
	$files = array_values(array_filter($files, function ($path) use ($filter) {
		$basename = basename($path);
		return $basename === $filter || str_contains($basename, $filter);
	}));
	if (empty($files)) {
		fwrite(STDERR, "No migration matched filter: {$filter}\n");
		exit(1);
	}
}

foreach ($files as $file) {
	$migration = require $file;
	if (is_object($migration) && method_exists($migration, $direction)) {
		printf("Running %s: %s\n", $direction, basename($file));
		$migration->{$direction}();
	} else {
		printf("Skip: %s (not a migration class)\n", basename($file));
	}
}

echo "Done." . PHP_EOL; 