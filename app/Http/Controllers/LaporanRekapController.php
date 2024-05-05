<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\LaporanRekapitulasi;
use App\Models\RekapBarangKeluar;
use App\Models\RekapBarangMasuk;
use App\Models\RekapStokBarang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LaporanRekapController extends Controller
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
    public function store(Request $request): \Illuminate\Http\RedirectResponse | \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'judul_rekap' => 'required',
            'keterangan' => 'required',
        ]);
        $id = auth()->user()->id;
        $data_barang = Barang::with('kategori')->get();
        $tanggal_sekarang = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
        $barang_masuk = BarangMasuk::with('barang.kategori')->whereDate('tanggal_masuk', $tanggal_sekarang)->get();
        $barang_keluar = BarangKeluar::with('barang.kategori')->whereDate('tanggal_keluar', $tanggal_sekarang)->get();
        $laporan_rekapitulasi_isEmpty = LaporanRekapitulasi::whereDate('tanggal_rekap', $tanggal_sekarang)->get();
        if ($laporan_rekapitulasi_isEmpty->isEmpty()) {
            $data = [];
            $laporan_rekapitulasi = LaporanRekapitulasi::create([
                'user_id' => $id,
                'judul_rekap' => $request->judul_rekap,
                'tanggal_rekap' => $tanggal_sekarang,
                'keterangan' => $request->keterangan,
            ]);
            for ($i = 0; $data_barang->count() > $i; $i++) {
                $data[] = [
                    'laporan_rekapitulasi_id' => $laporan_rekapitulasi->id,
                    'url_gambar' => $data_barang[$i]->url_gambar,
                    'nama_barang' => $data_barang[$i]->nama_barang,
                    'kuantitas' => $data_barang[$i]->kuantitas,
                    'harga' => $data_barang[$i]->harga,
                    'keterangan' => $data_barang[$i]->keterangan,
                    'kategori_id' => $data_barang[$i]->kategori->id,
                    'created_at' => now(),
                ];
            }
            RekapStokBarang::insert($data);

            // update barang masuk laporan_rekapitulasi_id
            foreach ($barang_masuk as $item) {
                RekapBarangMasuk::create([
                    'laporan_rekapitulasi_id' => $laporan_rekapitulasi->id,
                    'barang_id' => $item->barang_id,
                    'supplier_id' => $item->supplier_id,
                    'nama_barang' => $item->barang->nama_barang,
                    'tanggal_masuk' => $item->tanggal_masuk,
                    'kategori_id' => $item->barang->kategori_id,
                    'kuantitas' => $item->kuantitas,
                    'keterangan' => $item->keterangan,
                    'created_at' => now(),
                ]);
            }

            // update barang keluar laporan_rekapitulasi_id
            foreach ($barang_keluar as $item) {
                RekapBarangKeluar::create([
                    'laporan_rekapitulasi_id' => $laporan_rekapitulasi->id,
                    'barang_id' => $item->barang_id,
                    'kategori_id' => $item->barang->kategori_id,
                    'nama_barang' => $item->barang->nama_barang,
                    'tanggal_keluar' => $item->tanggal_keluar,
                    'kuantitas' => $item->kuantitas,
                    'keterangan' => $item->keterangan,
                    'created_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } else {
            return Redirect::back()->withErrors('Data sudah ada');
        }
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
