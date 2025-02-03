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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id('id_penjualan');
            $table->foreignId('id_pelanggan')->constrained(
                table: 'pelanggan', column: 'id_pelanggan');
            $table->date('tanggal_penjualan');
            $table->decimal('total_harga', total: 10, places: 2);
            $table->decimal('total_bayar', total: 10, places: 2);
            $table->decimal('kembalian', total: 10, places: 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
