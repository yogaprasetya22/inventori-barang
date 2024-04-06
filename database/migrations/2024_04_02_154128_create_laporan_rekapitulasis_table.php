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
        Schema::create('laporan_rekapitulasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('barang_masuk_id');
            $table->foreignId('barang_keluar_id');
            $table->foreignId('barang_id');
            $table->string('judul_rekap');
            $table->date('tanggal_rekap');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_rekapitulasis');
    }
};
