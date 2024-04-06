<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanRekapitulasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function barangMasuk()
    {
        return $this->belongsTo(BarangMasuk::class);
    }

    public function barangKeluar()
    {
        return $this->belongsTo(BarangKeluar::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
