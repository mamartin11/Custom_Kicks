<?php
// Miguel Angel Martinez
// Nicolas Hurtado A
// Santiago Rodriguez
// Jacobo Restrepo
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('item', 'items'); // Renombrar la tabla
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('items', 'item'); // Revertir en caso de rollback
    }
};
