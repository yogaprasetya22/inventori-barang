<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StokBarangContoller extends Controller
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
        // create new barang
        $request->validate([
            'nama_barang' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'keterangan' => 'required',
            'kuantitas' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10024',
        ]);

        $file = $request->file('file');
        $nama_file = time() . "_" . $file->getClientOriginalName();
        $tujuan_upload = 'img';
        $file->move($tujuan_upload, $nama_file);


        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'kuantitas' => $request->kuantitas,
            'url_gambar' => $request->header('origin') . '/img/' . $nama_file,
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
    public function update(Request $request): \Illuminate\Http\RedirectResponse
    {


        if ($request->hasFile('file')) {
            // delete old image
            $barang = Barang::where('id', $request->id)->first();
            $url_gambar = explode('/', $barang->url_gambar);
            $file = $url_gambar[count($url_gambar) - 1];
            unlink('img/' . $file);

            $file = $request->file('file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $tujuan_upload = 'img';
            $file->move($tujuan_upload, $nama_file);

            Barang::where('id', $request->id)->update([
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori_id,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'kuantitas' => $request->kuantitas,
                'url_gambar' => $request->header('origin') . '/img/' . $nama_file,
            ]);
        } else {
            Barang::where('id', $request->id)->update([
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori_id,
                'harga' => $request->harga,
                'keterangan' => $request->keterangan,
                'kuantitas' => $request->kuantitas,
            ]);
        }

        return redirect()->back()->with('success', 'Barang masuk berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        // delete image
        $barang = Barang::where('id', $request->id)->first();
        $url_gambar = explode('/', $barang->url_gambar);
        $file = $url_gambar[count($url_gambar) - 1];
        unlink('img/' . $file);

        Barang::where('id', $request->id)->delete();
        return Redirect::back()->with('success', 'Barang berhasil dihapus');
    }
}
