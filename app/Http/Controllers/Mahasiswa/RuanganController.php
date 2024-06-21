<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Models\Peminjaman;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $title = 'Halaman Ruangan';
        
        $gedungs = Gedung::paginate(2);
        // dd($gedungs);

        return view('mahasiswa.ruangan.index', compact(
            'title',
            'gedungs',
        ));
    }

    // public function index()
    // {
    //     $title = 'Halaman Ruangan';
        
    //     $ruangans = Ruangan::with('gedung')->where('bisa_pinjam', 1)->paginate(2);

    //     return view('mahasiswa.ruangan.index', compact(
    //         'title',
    //         'ruangans',
    //     ));
    // }

    public function get()
    {
        $judul = "Hapus Kegiatan";
        $ruangans = Ruangan::with('gedung')->paginate(1);
        $view = view('mahasiswa.ruangan.list', compact('judul', 'ruangans'))->render();
        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    public function byGedung($id)
    {
        $title = "Ruangan";
        $ruangans = Ruangan::where('gedung_id', decrypt($id))->paginate(2);
        return view('mahasiswa.ruangan.ruangan', compact(
            'title',
            'ruangans',
        ));
    }
    // public function show($id)
    // {
    //     $title = "Booking Ruangan";

    //     $ruangan = Ruangan::with('gedung')->findOrFail(decrypt($id));
    //     // dd($ruangan);


    //     return view('mahasiswa.ruangan.create', compact(
    //         'title',
    //         'ruangan',
    //     ));
    //     // return response()->json([
    //     //     'success' => true,
    //     //     'html' => $view
    //     // ]);
    // }

    // public function ubah_peminjaman($id)
    // {
    //     $title = "Ubah Data Booking";
    //     $data = PeminjamanRuangan::with(['ruangan.gedung'])->where('id', $id);
    //     $ruangan = Ruangan::with('gedung')->findOrFail($id);
    //     dd($data);
    //     // $ruangans = Ruangan::with('gedung')->get();
    //     // $dataBarang = Barang::where('id', $id)->first();

    //     return  view('mahasiswa.ruangan.edit', compact(
    //         'title',
    //         'data',
    //         'ruangan'
    //     ));
    // }


    // public function store(Request $request)
    // {
    //     // dd(date('Y-m-d H:i', strtotime($request->waktu_peminjaman)));
    //     $dataValid =  $request->validate([
    //         'ruangan_id' => 'required',
    //         'kegiatan' => 'required',
    //         'tgl_pinjam' => 'required',
    //         'jam_pinjam' => 'required',
    //         'jam_selesai' => 'required',
    //     ]);
    //     $dataValid['user_id'] = auth()->user()->id;
    //     $dataValid['tgl_pinjam'] = date('Y-m-d', strtotime($request->tgl_pinjam));
    //     $dataValid['jam_pinjam'] = date('H:i', strtotime($request->jam_pinjam));
    //     $dataValid['jam_selesai'] = date('H:i', strtotime($request->jam_selesai));

    //     // Periksa apakah ada peminjaman dengan tanggal dan jam yang sama dan status 2
    //     $existingBooking = PeminjamanRuangan::where('tgl_pinjam', $dataValid['tgl_pinjam'])
    //         ->where('jam_pinjam', $dataValid['jam_pinjam'])
    //         ->where('status', 2)
    //         ->exists();

    //     if ($existingBooking) {
    //         return back()->with('error', 'Ruangan sudah dibooking pada tanggal dan jam yang sama. Silakan coba pada tanggal atau jam lain.');
    //     }

    //     PeminjamanRuangan::create($dataValid);

    //     return redirect()->route('ruangan.list')->with('success', 'Ruangan Berhasil Di Booking');
    // }



    // public function list_peminjaman()
    // {
    //     $title = "List Peminjaman";
    //     // $user = auth()->user()->id;
    //     // $listPeminjaman = PeminjamanRuangan::with(['ruangan', 'gedung'])->where('user_id', $user)->get();

    //     $user_id = auth()->id();
    //     $listPeminjaman = PeminjamanRuangan::with(['ruangan.gedung'])->where('user_id', $user_id)->get();

    //     // dd($listPeminjaman);

    //     return view('mahasiswa.ruangan.list_peminjaman', compact(
    //         'title',
    //         'listPeminjaman',
    //     ));
    // }

    // public function PrintPdf($id)
    // {
    //     try {
    //         $title = 'Cetak Peminjaman Aset';
    //         $dataBooking = PeminjamanRuangan::with(['user', 'ruangan.gedung'])
    //             ->where('id', $id)
    //             ->firstOrFail();
            
    //             // dd($dataBooking);

    //         return view('mahasiswa.ruangan.cetakpdf', compact('title', 'dataBooking'));
    //     } catch (ModelNotFoundException $e) {
    //         abort(404);
    //     }
    // }

    // public function destroy($id)
    // {
    //     PeminjamanRuangan::where("id", $id)->delete();
    //     return back()->with('success', 'Berhasil Menghapus Data');
    // }
}
// $peminjaman = Ruangan::with('ruangan')->where('user_id', $user);
