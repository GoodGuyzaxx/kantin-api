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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->uuid('id_order');
            $table->foreignId('id_kantin')->constrained('kantins', 'id_kantin')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('total_harga');
            $table->string('menu');
            $table->enum('tipe_pembayaran',['tunai','non-tunai']);
            $table->string('status_pembayaran');
            $table->string("email_konsumen");
            $table->string("nama_konsumen");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
