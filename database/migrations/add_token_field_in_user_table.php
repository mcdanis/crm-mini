<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up(): void
    {
        $schema = Capsule::schema();
        $tableName = 'users';

        if ($schema->hasTable($tableName)) {
        
            if (!$schema->hasColumn($tableName, 'token')) {
				$schema->table($tableName, function (Blueprint $table) {
					$table->string('token', 30)->nullable()->after('email');
                });
            }
			if (!$schema->hasColumn($tableName, 'token_expire_at')) {
				$schema->table($tableName, function (Blueprint $table) {
					$table->timestamp('token_expire_at')->nullable()->after('email');
				});
			}
			
        }
    }
	
    public function down(): void
    {
		$schema = Capsule::schema();
        $tableName = 'users';
		
        if ($schema->hasTable($tableName)) {
			$schema->table($tableName, function (Blueprint $table) use ($schema, $tableName) {
				if ($schema->hasColumn($tableName, 'token')) {
                    $table->dropColumn('token');
                }
				if ($schema->hasColumn($tableName, 'token_expire_at')) {
                    $table->dropColumn('token_expire_at');
                }
            });
        }
    }
};
