<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up(): void
    {
        $schema = Capsule::schema();
        $tableName = 'orders';

        if ($schema->hasTable($tableName)) {

            if (!$schema->hasColumn($tableName, 'payment_method')) {
                $schema->table($tableName, function (Blueprint $table) {
                    $table->string('payment_method', 20)->nullable()->after('note');
                });
            }
            if (!$schema->hasColumn($tableName, 'references')) {
                $schema->table($tableName, function (Blueprint $table) {
                    $table->string('references', 100)->nullable()->after('note');
                });
            }

            if (!$schema->hasColumn($tableName, 'payment_note')) {
                $schema->table($tableName, function (Blueprint $table) {
                    $table->text('payment_note')->nullable()->after('note');
                });
            }
        }
    }

    public function down(): void
    {
        $schema = Capsule::schema();
        $tableName = 'orders';

        if ($schema->hasTable($tableName)) {
            $schema->table($tableName, function (Blueprint $table) use ($schema, $tableName) {
                if ($schema->hasColumn($tableName, 'payment_note')) {
                    $table->dropColumn('payment_note');
                }
                if ($schema->hasColumn($tableName, 'references')) {
                    $table->dropColumn('references');
                }
                if ($schema->hasColumn($tableName, 'payment_method')) {
                    $table->dropColumn('payment_method');
                }
            });
        }
    }
};
