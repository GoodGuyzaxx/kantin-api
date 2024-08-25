<?php

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
        Schema::create('neighbors', function (Blueprint $table) {
            $table->id('neighbor_id');
            $table->foreignId('id_konsumen')->constrained('konsumens','id_konsumen');
            $table->text('to_konsumen_id');
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neighbors');
    }
};
