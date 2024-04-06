<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function laporanRekapitulasi()
    {
        return $this->hasMany(LaporanRekapitulasi::class);
    }
}
