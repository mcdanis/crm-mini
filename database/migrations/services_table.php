<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();
		$tableName = 'services';
		if (!$schema->hasTable($tableName)) {
			$schema->create($tableName, function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name', 200);
				$table->text('description')->nullable();
				$table->decimal('default_price', 12, 2)->default(0.00);
				$table->timestamps(); // created_at & updated_at
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists($tableName);
	}
}; 