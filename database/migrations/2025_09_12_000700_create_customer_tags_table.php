<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('customer_tags')) {
			$schema->create('customer_tags', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('customer_id');
				$table->string('name', 255);
				$table->timestamp('created_at')->useCurrent();
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('customer_tags');
	}
}; 