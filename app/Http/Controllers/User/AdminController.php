<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\LaporanRekapitulasi;
use App\Models\RekapBarangKeluar;
use App\Models\RekapBarangMasuk;
use App\Models\RekapStokBarang;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $BarangMasuk = BarangMasuk::with('barang')->get();
        $pengeluaran = BarangMasuk::with('barang')->get();
        $BarangKeluar = BarangKeluar::with('barang')->get();
        $pendapatan = BarangKeluar::with('barang')->get();
        $data = [
            'BarangMasuk' => $BarangMasuk,
            'BarangKeluar' => $BarangKeluar,
            'pengeluaran' => $pengeluaran,
            'pendapatan' => $pendapatan,
        ];
        return Inertia::render('admin/Admin', [
            'title' => 'Admin',
            'data' => $data,
        ]);
    }

    // stok barang
    public function stok_barang()
    {
        $kategori = Kategori::all();
        $data_barang = Barang::with(['kategori'])->latest()->get();
        return Inertia::render('admin/StokBarang', [
            'title' => 'Stok Barang',
            'data_barang' => $data_barang,
            'kategori' => $kategori,
        ]);
    }

    // barang masuk
    public function barang_masuk()
    {
        $supplier = Supplier::all();
        $barang = Barang::with(['kategori'])->get();
        $data_barang_masuk = BarangMasuk::with(['barang', 'supplier', 'kategori'])->latest()->get();
        return Inertia::render('admin/BarangMasuk', [
            'title' => 'Barang Masuk',
            'data_barang_masuk' => $data_barang_masuk,
            'supplier' => $supplier,
            'barang' => $barang,
        ]);
    }

    // barang keluar
    public function barang_keluar()
    {
        $barang = Barang::with(['kategori'])->get();
        $data_barang_keluar = BarangKeluar::with(['barang', 'kategori'])->latest()->get();
        return Inertia::render('admin/BarangKeluar', [
            'title' => 'Barang Keluar',
            'data_barang_keluar' => $data_barang_keluar,
            'barang' => $barang,
        ]);
    }

    // data mekanik
    public function data_mekanik()
    {
        $data_mekanik = User::with(['role'])->where('role_id', 3)->latest()->get();
        return Inertia::render('admin/DataMekanik', [
            'title' => 'Data Mekanik',
            'data_mekanik' => $data_mekanik,
        ]);
    }

    // data owner
    public function data_owner()
    {
        $data_owner = User::with(['role'])->where('role_id', 2)->latest()->get();
        return Inertia::render('admin/DataOwner', [
            'title' => 'Data Owner',
            'data_owner' => $data_owner,
        ]);
    }

    // laporan rekap
    public function laporan_rekap()
    {
        $data_laporan_rekap = LaporanRekapitulasi::with(['rekap_stok_barang', 'rekap_barang_masuk', 'rekap_barang_keluar', 'user'])->latest()->get();
        $barang = Barang::with(['kategori'])->get();
        $barang_masuk = BarangMasuk::with(['barang', 'supplier', 'kategori'])->get();
        $barang_keluar = BarangKeluar::with(['barang', 'kategori'])->get();
        return Inertia::render('admin/LaporanRekap', [
            'title' => 'Laporan Rekap',
            'data_laporan_rekap' => $data_laporan_rekap,
            'barang' => $barang,
            'barang_masuk' => $barang_masuk,
            'barang_keluar' => $barang_keluar,
        ]);
    }

    // detail laporan rekap barang
    public function detail_laporan_rekap_stok_barang($id)
    {
        $data_barang = RekapStokBarang::with(['laporanRekapitulasi', 'kategori'])->where('laporan_rekapitulasi_id', $id)->get();
        return Inertia::render('admin/rekap/Barang', [
            'title' => 'Detail Laporan Rekap Stok Barang',
            'data_barang' => $data_barang,
        ]);
    }

    // detail laporan rekap barang masuk
    public function detail_laporan_rekap_barang_masuk($id)
    {
        $data_barang_masuk = RekapBarangMasuk::with(['laporanRekapitulasi', 'barang', 'supplier', 'kategori'])->where('laporan_rekapitulasi_id', $id)->get();
        return Inertia::render('admin/rekap/BarangMasuk', [
            'title' => 'Detail Laporan Rekap Barang Masuk',
            'data_barang_masuk' => $data_barang_masuk,
        ]);
    }

    // detail laporan rekap barang keluar
    public function detail_laporan_rekap_barang_keluar($id)
    {
        $data_barang_keluar = RekapBarangKeluar::with(['laporanRekapitulasi', 'barang', 'kategori'])->where('laporan_rekapitulasi_id', $id)->get();
        
        return Inertia::render('admin/rekap/BarangKeluar', [
            'title' => 'Detail Laporan Rekap Barang Keluar',
            'data_barang_keluar' => $data_barang_keluar,
        ]);
    }
}
