<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // create new barang keluar
        $request->validate([
            'barang_id' => 'required',
            'kuantitas' => 'required',
            'keterangan' => 'required',
        ]);

        $barang = Barang::where('id', $request->barang_id)->first();

        $barang->update([
            'kuantitas' => $barang->kuantitas - $request->kuantitas,
        ]);

        BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'kategori_id' => $barang->kategori_id,
            'nama_barang' => $barang->nama_barang,
            'tanggal_keluar' => Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d'),
            'kuantitas' => $request->kuantitas,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Barang keluar berhasil ditambahkan');
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
        // update barang keluar
        $request->validate([
            'barang_id' => 'required',
            'kuantitas' => 'required',
            'keterangan' => 'required',
        ]);
        $barang = Barang::where('id', $request->barang_id)->first();

        $barang->update([
            'kuantitas' => $barang->kuantitas - $request->kuantitas,
        ]);

        $barang_keluar = BarangKeluar::where('id', $request->id)->first();

        $barang_keluar->update([
            'barang_id' => $request->barang_id,
            'kuantitas' => $request->kuantitas,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Barang keluar berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // delete barang keluar
        $barang_keluar = BarangKeluar::where('id', $request->id)->first();
        $barang = Barang::where('id', $barang_keluar->barang_id)->first();
        $barang->update([
            'kuantitas' => $barang->kuantitas + $barang_keluar->kuantitas,
        ]);
        $barang_keluar->delete();

        return redirect()->back()->with('success', 'Barang keluar berhasil dihapus');
    }
}
