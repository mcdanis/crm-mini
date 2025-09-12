<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('customer_stats')) {
			$schema->create('customer_stats', function (Blueprint $table) {
				$table->unsignedBigInteger('customer_id')->primary();
				$table->integer('total_orders')->unsigned()->default(0);
				$table->decimal('total_spent', 14, 2)->default(0.00);
				$table->dateTime('last_order_at')->nullable();
				$table->decimal('avg_order_value', 12, 2)->default(0.00);
				$table->float('retention_score')->default(0);
				$table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('customer_stats');
	}
}; 