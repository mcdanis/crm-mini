<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('recommendations')) {
			$schema->create('recommendations', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->unsignedBigInteger('customer_id');
				$table->text('recommendation_text');
				$table->float('score')->default(0);
				$table->json('reason')->nullable();
				$table->timestamp('created_at')->useCurrent();
				$table->unsignedBigInteger('created_by')->nullable();
				$table->tinyInteger('acted_on')->default(0);
				$table->dateTime('acted_at')->nullable();

				$table->index('customer_id');
				$table->index('score');
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('recommendations');
	}
}; 