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
             //ForeingKeys
             $table->foreignId('product_id')->constrained()->onDelete('cascade');
             $table->foreignId('customization_id')->default(0)->constrained()->onDelete('cascade');
             $table->foreignId('order_id')->constrained()->onDelete('cascade');
 
             $table->timestamps();
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