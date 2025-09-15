<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();
		$tableName = 'customers';
		if (!$schema->hasTable($tableName)) {
			$schema->create($tableName, function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('full_name', 200);
				$table->string('email', 255)->nullable();
				$table->string('phone', 50)->nullable();
				$table->date('birthday')->nullable();
				$table->string('company_name', 255)->nullable();
				$table->text('address')->nullable();
				$table->string('suburb', 150)->nullable();
				$table->string('state', 150)->nullable();
				$table->string('postcode', 20)->nullable();
				$table->text('note')->nullable();
				$table->string('source', 100)->nullable(); // e.g. instagram, referral, google
				$table->unsignedBigInteger('tag_id')->nullable();
				$table->unsignedInteger('total_orders')->default(0);    // cached
				$table->decimal('total_spent', 14, 2)->default(0.00);   // cached
				$table->dateTime('last_order_at')->nullable();          // cached
				$table->timestamps();                                   // created_at, updated_at
				$table->dateTime('deleted_at')->nullable();             // soft delete

				$table->unsignedBigInteger('created_by')->nullable();

				// Indexes
				$table->index('email');
				$table->index('phone');
				$table->index('company_name');

				// Foreign key
				$table->foreign('created_by')
					->references('id')->on('users')
					->onDelete('set null');
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('customers');
	}
};
