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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu');
            $table->foreignId('id_kantin');
            $table->string('nama_menu',255);
            $table->string('deskripsi');
            $table->unsignedBigInteger('harga');
            $table->string('gambar',255)->nullable();
            $table->integer('stock');
            $table->enum('category',['makanan','minuman']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
