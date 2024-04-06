<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = ['nama_kategori'];
    public $timestamps = false;

    public function barang()
    {
        return $this->hasOne(Barang::class);
    }

    public function barangMasuk()
    {
        return $this->hasOne(Barang::class);
    }

    public function barangKeluar()
    {
        return $this->hasOne(Barang::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }
}
