<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapStokBarang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function laporanRekapitulasi()
    {
        return $this->belongsTo(LaporanRekapitulasi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
