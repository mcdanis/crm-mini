<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

return new class {
    public function up(): void
    {
        $schema = Capsule::schema();
        $tableName = 'order_items';
        if (!$schema->hasTable($tableName)) {
            $schema->create($tableName, function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('order_id');
                $table->bigInteger('service_id');
                $table->string('name')->nullable();
                $table->bigInteger('quantity');
                $table->bigInteger('unit_price');

                $table->bigInteger('discount')->nullable();
                $table->bigInteger('custom_price')->nullable();

                $table->timestamps();

                $table->index('order_id');
                $table->index('service_id');
                $table->index('name');
            });
        }
    }

    public function down(): void
    {
        $schema = Capsule::schema();
        $schema->dropIfExists('order_items');
    }
};
