<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();
		$tableName = 'settings';
		if (!$schema->hasTable($tableName)) {
			$schema->create($tableName, function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('app_name', 200)->nullable();
				$table->text('logo')->nullable();
				$table->string('currency', 10)->nullable();
				$table->string('language', 4)->nullable();
				$table->string('timezone', 30)->nullable();
				$table->timestamps(); // created_at & updated_at
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('settings');
	}
};
