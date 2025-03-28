<?php
// Nicolas Hurtado A
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customizations', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->string('design');
            $table->string('pattern');
            $table->string('image');
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('customizations');
    }
};
