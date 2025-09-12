<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('orders')) {
			$schema->create('orders', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('customer_id')->nullable();
				$table->string('status', 50)->default('draft');
				$table->date('order_date');
				$table->text('note')->nullable();
				$table->decimal('total_amount', 14, 2)->default(0.00);
				$table->decimal('total_paid', 14, 2)->default(0.00);
				$table->dateTime('scheduled_at')->nullable();
				$table->dateTime('deleted_at')->nullable();
				$table->unsignedBigInteger('created_by')->nullable();
				$table->timestamps();

				$table->index('customer_id');
				$table->index('order_date');
				$table->index('status');
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();

		if ($schema->hasTable('orders')) {
			
			$schema->drop('orders');
		}
	}
}; 