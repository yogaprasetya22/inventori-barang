<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangMasukController extends Controller
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
        // create new barang masuk
        $request->validate([
            'barang_id' => 'required',
            'supplier_id' => 'required',
            'kategori_id' => 'required',
            'kuantitas' => 'required',
            'keterangan' => 'required',
        ]);

        $barang = Barang::where('id', $request->barang_id)->first();

        $barang->update([
            'kuantitas' => $barang->kuantitas + $request->kuantitas,
        ]);

        BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'nama_barang' => $barang->nama_barang,
            'tanggal_masuk' => Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d'),
            'kategori_id' => $request->kategori_id,
            'kuantitas' => $request->kuantitas,
            'keterangan' => $request->keterangan,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Barang masuk berhasil ditambahkan');
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
        // update barang masuk
        $request->validate([
            'barang_id' => 'required',
            'supplier_id' => 'required',
            'kuantitas' => 'required',
            'keterangan' => 'required',
        ]);

        $barang = Barang::where('id', $request->barang_id)->first();

        $barang->update([
            'kuantitas' => $barang->kuantitas + $request->kuantitas,
        ]);

        BarangMasuk::where('id', $request->id)->update([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'kuantitas' => $request->kuantitas,
            'keterangan' => $request->keterangan,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Barang masuk berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // delete barang masuk
        $barang_masuk = BarangMasuk::where('id', $request->id)->first();
        $barang = Barang::where('id', $barang_masuk->barang_id)->first();
        $barang->update([
            'kuantitas' => $barang->kuantitas - $barang_masuk->kuantitas,
        ]);
        $barang_masuk->delete();
        return redirect()->back()->with('success', 'Barang masuk berhasil dihapus');
    }
}
