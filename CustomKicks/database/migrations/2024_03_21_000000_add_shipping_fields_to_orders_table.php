<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('shipping_type')->default('standard');
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->string('tracking_number')->nullable();
            $table->string('status')->default('pending');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['shipping_type', 'shipping_cost', 'tracking_number', 'status']);
        });
    }
}; 