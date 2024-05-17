<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Detailpeminjaman;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        // dd(date('Y-m-d H:i', strtotime($request->waktu_peminjaman)));
        $dataValid =  $request->validate([
            'ruangan_id' => 'required',
            'kegiatan' => 'required',
            'waktu_peminjaman' => 'required',
            'waktu_pengembalian' => 'required',
            // 'jam_peminjaman' => 'required',
            // 'jam_pengembalian' => 'required',
        ]);
        $dataValid['user_id'] = auth()->user()->id;
        $dataValid['waktu_peminjaman'] = date('Y-m-d H:i', strtotime($request->waktu_peminjaman));
        $dataValid['waktu_pengembalian'] = date('Y-m-d H:i', strtotime($request->waktu_pengembalian));
        // $dataValid['jam_peminjaman'] = date('H:i', strtotime($request->jam_peminjaman));
        // $dataValid['jam_pengembalian'] = date('H:i', strtotime($request->jam_pengembalian));
        
        Peminjaman::create($dataValid);

        return response()->json(['message' => 'Data peminjaman berhasil disimpan'], 200);
    }


    public function show($id)
    {
        $title = 'Detail peminjaman barang';
        $barangs = Barang::with('ruangan.gedung')->get();

        $dataPeminjaman = Peminjaman::with(['user', 'detail_peminjaman.barang','ruangan'])
            ->where('id', decrypt($id))
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
        Peminjaman::where("id", $id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Data', 'class' => 'alert-success']);
    }



    public function hapusdetail($id)
    {
        // dd($id);
        Detailpeminjaman::where("id", $id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }

    

public function PrintPdf($id)
{
    try {
        $title = 'Cetak Peminjaman Aset';
        $dataPeminjaman = Peminjaman::with(['user', 'detail_peminjaman.barang'])
            ->where('id', decrypt($id))
            ->firstOrFail();

        return view('mahasiswa.aset.cetakpdf', compact('title', 'dataPeminjaman'));
    } catch (ModelNotFoundException $e) {
        abort(404);
    }
}

}
