<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangKeluar;
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
        return Inertia::render('mekanik/Index', [
            'title' => 'Mekanik',
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
        return Inertia::render('admin/LaporanRekap', [
            'title' => 'Laporan Rekap',
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
