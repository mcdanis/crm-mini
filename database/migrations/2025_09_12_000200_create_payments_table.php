<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('payments')) {
			$schema->create('payments', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('order_id')->nullable();
				$table->dateTime('payment_date')->useCurrent();
				$table->decimal('amount', 14, 2);
				$table->string('payment_method', 100)->nullable();
				$table->string('reference', 255)->nullable();
				$table->text('note')->nullable();
				$table->timestamp('created_at')->useCurrent();
				$table->unsignedBigInteger('created_by')->nullable();

				$table->index('order_id');
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('payments');
	}
}; 