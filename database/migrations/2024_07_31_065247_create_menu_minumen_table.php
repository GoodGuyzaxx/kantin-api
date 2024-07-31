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
        Schema::create('menu_minumen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_minuman',255);
            $table->string('deskripsi');
            $table->float('harga');
            $table->string('gambar',255)->nullable();
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_minumen');
    }
};
