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
        Schema::create('rekap_stok_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_rekapitulasi_id');
            $table->text('url_gambar');
            $table->string('nama_barang');
            $table->integer('kuantitas');
            $table->string('harga');
            $table->text('keterangan');
            $table->foreignId('kategori_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_stok_barangs');
    }
};
