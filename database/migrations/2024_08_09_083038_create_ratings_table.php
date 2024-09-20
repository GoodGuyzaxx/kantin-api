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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_konsumen')->constrained('konsumens','id_konsumen')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('id_menu')->nullable()->constrained('menus','id_menu')->cascadeOnDelete()->cascadeOnUpdate();
            $table->tinyInteger('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
