<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('activities')) {
			$schema->create('activities', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('customer_id')->nullable();
				$table->unsignedBigInteger('order_id')->nullable();
				$table->string('activity_type', 50);
				$table->string('activity_subtype', 100)->nullable();
				$table->string('title', 255)->nullable();
				$table->text('body')->nullable();
				$table->dateTime('occurred_at')->useCurrent();
				$table->unsignedBigInteger('created_by')->nullable();
				$table->timestamp('created_at')->useCurrent();

				$table->index('customer_id');
				$table->index('order_id');
				$table->index('activity_type');
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('activities');
	}
}; 