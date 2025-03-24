<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item', function (Blueprint $table) {
            $table->id();
            $table->integer('subtotal');
            $table->timestamps();
            // ForeingKeys
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('customization_id')->references('id')->on('customizations')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropifexist('item');
    }
};
