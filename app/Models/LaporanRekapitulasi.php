<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanRekapitulasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rekap_stok_barang()
    {
        return $this->hasMany(RekapStokBarang::class);
    }

    public function rekap_barang_masuk()
    {
        return $this->hasMany(RekapBarangMasuk::class);
    }

    public function rekap_barang_keluar()
    {
        return $this->hasMany(RekapBarangKeluar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
