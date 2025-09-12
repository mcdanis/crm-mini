<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
	public function up(): void
	{
		$schema = Capsule::schema();

		if (!$schema->hasTable('import_export_jobs')) {
			$schema->create('import_export_jobs', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('job_type', 20);
				$table->string('file_path', 500)->nullable();
				$table->string('status', 50)->default('pending');
				$table->integer('total_rows')->nullable();
				$table->integer('processed_rows')->nullable()->default(0);
				$table->text('error_message')->nullable();
				$table->unsignedBigInteger('initiated_by')->nullable();
				$table->dateTime('started_at')->nullable();
				$table->dateTime('finished_at')->nullable();
				$table->timestamp('created_at')->useCurrent();

				$table->index('job_type');
			});
		}
	}

	public function down(): void
	{
		$schema = Capsule::schema();
		$schema->dropIfExists('import_export_jobs');
	}
}; 