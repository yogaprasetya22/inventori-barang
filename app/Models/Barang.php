<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function rekapBarangMasuk()
    {
        return $this->hasMany(RekapBarangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

    public function rekapBarangkeluar()
    {
        return $this->hasMany(RekapBarangkeluar::class);
    }

    public function laporanRekapitulasi()
    {
        return $this->belongsTo(LaporanRekapitulasi::class);
    }
}
