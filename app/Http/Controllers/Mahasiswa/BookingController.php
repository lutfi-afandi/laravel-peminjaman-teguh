<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BookingController extends Controller
{

    public function index()
    {
        $title = "List Peminjaman";

        $user_id = auth()->id();
        $listPeminjaman = PeminjamanRuangan::with(['ruangan.gedung'])->where('user_id', $user_id)->get();

        // dd($listPeminjaman);

        return view('mahasiswa.ruangan.list_peminjaman', compact(
            'title',
            'listPeminjaman',
        ));
    }

    public function show($id)
    {
        $title = "Booking Ruangan";

        $ruangan = Ruangan::with('gedung')->findOrFail(decrypt($id));
        // dd($ruangan);


        return view('mahasiswa.ruangan.create', compact(
            'title',
            'ruangan',
        ));
    }

    public function edit($id)
    {
        $title = "Ubah Data Booking";
        // untuk mendapatkan satu peminjaman ruangan dengan ID yang diberikan
        $data = PeminjamanRuangan::with(['ruangan.gedung'])->findOrFail(decrypt($id));
        // ruangan terkait dengan peminjaman ruangan
        $ruangan = Ruangan::with('gedung')->findOrFail($data->ruangan_id);

        return  view('mahasiswa.ruangan.edit', compact(
            'title',
            'data',
            'ruangan'
        ));
    }


    public function store(Request $request)
    {
        // dd(date('Y-m-d H:i', strtotime($request->waktu_peminjaman)));
        $dataValid =  $request->validate([
            'ruangan_id' => 'required',
            'kegiatan' => 'required',
            'waktu_pinjam' => 'required',
            // 'jam_pinjam' => 'required',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_pinjam',
        ]);
        $dataValid['user_id'] = auth()->user()->id;
        $dataValid['waktu_pinjam'] = date('Y-m-d H:i', strtotime($request->waktu_pinjam));
        $dataValid['waktu_selesai'] = date('Y-m-d H:i', strtotime($request->waktu_selesai));
        // $dataValid['jam_selesai'] = date('H:i', strtotime($request->jam_selesai));

        // Periksa apakah ada peminjaman dengan tanggal dan jam yang sama dan status 2
        $existingBooking = PeminjamanRuangan::where('ruangan_id', $dataValid['ruangan_id'])->where('waktu_pinjam', $dataValid['waktu_pinjam'])
            ->where('status', 2)
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'Ruangan sudah dibooking pada tanggal dan jam yang sama. Silakan coba pada tanggal atau jam lain.');
        }

        PeminjamanRuangan::create($dataValid);

        return redirect()->route('mahasiswa.ruangan.index')->with('success', 'Ruangan Berhasil Di Booking');
    }


    public function update(Request $request, $id)
    {

        $dataValid =  $request->validate([
            'ruangan_id' => 'required',
            'kegiatan' => 'required',
            'waktu_pinjam' => 'required',
            // 'jam_pinjam' => 'required',
            'waktu_selesai' => 'required',
        ]);
        $dataValid['user_id'] = auth()->user()->id;
        $dataValid['waktu_pinjam'] = date('Y-m-d H:i', strtotime($request->waktu_pinjam));
        // $dataValid['jam_pinjam'] = date('H:i', strtotime($request->jam_pinjam));
        $dataValid['waktu_selesai'] = date('Y-m-d H:i', strtotime($request->waktu_selesai));

        // Periksa apakah ada peminjaman dengan tanggal dan jam yang sama dan status 2
        $existingBooking = PeminjamanRuangan::where('ruangan_id', $dataValid['ruangan_id'])->where('waktu_pinjam', $dataValid['waktu_pinjam'])
            ->where('status', 2)
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'Ruangan sudah dibooking pada tanggal dan jam yang sama. Silakan coba pada tanggal atau jam lain.');
        }


        
        PeminjamanRuangan::where('id', decrypt($id))->update($dataValid);
        // PeminjamanRuangan::update($dataValid);

        return redirect()->route('mahasiswa.ruangan.index')->with('success', 'Berhasil Edit Booking Ruangan');
    }



    public function PrintPdf($id)
    {
        $title = 'Cetak Peminjaman Aset';
        $decryptedId = decrypt($id);
        $dataBooking = PeminjamanRuangan::with(['user', 'ruangan.gedung'])
            ->where('id', $decryptedId)
            ->firstOrFail();

        return view('mahasiswa.ruangan.cetakpdf', compact('title', 'dataBooking'));
    }

    

    public function destroy($id)
    {
        PeminjamanRuangan::where("id", $id)->delete();
        return back()->with('success', 'Berhasil Menghapus Data');
    }
}
// $peminjaman = Ruangan::with('ruangan')->where('user_id', $user);
