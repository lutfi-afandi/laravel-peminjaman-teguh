<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Detailpeminjaman;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        $dataPeminjaman = Peminjaman::with(['user', 'detail_peminjaman.barang', 'ruangan'])
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();

        $view = view('mahasiswa.aset.list_peminjaman', compact('dataPeminjaman'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }


    public function create()
    {
        $title = "Buat Peminjaman";
        $dataRuangan = Ruangan::with('gedung')->get();
        $view = view('mahasiswa.aset.buatpeminjaman', compact('title', 'dataRuangan'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }


    public function store(Request $request)
    {
        $dataValid =  $request->validate([
            'ruangan_id' => 'required',
            'tgl_peminjaman' => 'required|date',
            'jam_peminjaman' => 'required',
            'tgl_pengembalian' => 'required|date',
            'jam_pengembalian' => 'required',
            'kegiatan' => 'required',
        ]);
        $dataValid['user_id'] = auth()->user()->id;
        // dd($dataValid);
        Peminjaman::create($dataValid);

        return response()->json(['message' => 'Data peminjaman berhasil disimpan'], 200);
    }


    public function show($id)
    {
        $title = 'Detail peminjaman barang';
        $barangs = Barang::with('ruangan.gedung')->get();

        $dataPeminjaman = Peminjaman::with(['user', 'detail_peminjaman.barang'])
            ->where('id', $id)
            ->first();
        // dd($dataPeminjaman->kegiatan);
        return view('mahasiswa.aset.tambahdetail', compact(
            'title',
            'dataPeminjaman',
            'barangs'
        ));
    }

    public function getbarang($pinjambarang_id)
    {
        $dataBarang = Detailpeminjaman::with(['barang', 'peminjaman_barang'])
            ->where('pinjambarang_id', $pinjambarang_id)
            ->get();

        // dd($dataBarang[1]->id);

        $view = view('mahasiswa.aset.listdetail', compact('dataBarang'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }



    public function hapusdetail($id)
    {
        // dd($id);
        Detailpeminjaman::where("id", $id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
