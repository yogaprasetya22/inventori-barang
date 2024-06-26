<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\LaporanRekapitulasi;
use App\Models\RekapBarangKeluar;
use App\Models\RekapBarangMasuk;
use App\Models\RekapStokBarang;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MekanikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        return Inertia::render('mekanik/Index', [
            'title' => 'Mekanik',
            'data' => $data,
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

    // laporan rekap
    public function laporan_rekap()
    {
        $data_laporan_rekap = LaporanRekapitulasi::with(['rekap_stok_barang', 'rekap_barang_masuk', 'rekap_barang_keluar', 'user'])->latest()->get();
        $barang = Barang::with(['kategori'])->get();
        $barang_masuk = BarangMasuk::with(['barang', 'supplier', 'kategori'])->get();
        $barang_keluar = BarangKeluar::with(['barang', 'kategori'])->get();
        return Inertia::render('mekanik/LaporanRekap', [
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
        return Inertia::render('mekanik/rekap/Barang', [
            'title' => 'Detail Laporan Rekap Stok Barang',
            'data_barang' => $data_barang,
        ]);
    }

    // detail laporan rekap barang masuk
    public function detail_laporan_rekap_barang_masuk($id)
    {
        $data_barang_masuk = RekapBarangMasuk::with(['laporanRekapitulasi', 'barang', 'supplier', 'kategori'])->where('laporan_rekapitulasi_id', $id)->get();
        return Inertia::render('mekanik/rekap/BarangMasuk', [
            'title' => 'Detail Laporan Rekap Barang Masuk',
            'data_barang_masuk' => $data_barang_masuk,
        ]);
    }

    // detail laporan rekap barang keluar
    public function detail_laporan_rekap_barang_keluar($id)
    {
        $data_barang_keluar = RekapBarangKeluar::with(['laporanRekapitulasi', 'barang', 'kategori'])->where('laporan_rekapitulasi_id', $id)->get();
        return Inertia::render('mekanik/rekap/BarangKeluar', [
            'title' => 'Detail Laporan Rekap Barang Keluar',
            'data_barang_keluar' => $data_barang_keluar,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create new mekanik
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => '3',
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Data mekanik berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if ($request->password) {
            User::where('id', $request->id)->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        } else {
            User::where('id', $request->id)->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);
        }

        return redirect()->back()->with('success', 'Data mekanik berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::where('id', $request->id)->delete();

        return redirect()->back()->with('success', 'Data mekanik berhasil dihapus');
    }
}
