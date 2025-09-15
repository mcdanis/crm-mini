<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up(): void
    {
        $schema = Capsule::schema();
        $tableName = 'tags';
        if (!$schema->hasTable($tableName)) {
            $schema->create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 10)->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        $schema = Capsule::schema();
        $schema->dropIfExists('tags');
    }
};
