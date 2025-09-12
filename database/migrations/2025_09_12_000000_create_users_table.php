<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('users')) {
			$schema->create('users', function (Blueprint $table) {
				$table->bigIncrements('id');
                $table->string('email', 255)->unique();
                $table->string('full_name', 150);
                $table->string('password_hash', 255)->nullable(); // if using local auth
                $table->string('role', 10)->default('user');       // e.g. admin, user, sales
                $table->boolean('is_active')->default(true);              // flexible metadata
                $table->timestamps();
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('users');
	}
}; 