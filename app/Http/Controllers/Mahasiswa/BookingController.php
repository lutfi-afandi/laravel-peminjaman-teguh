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
        $listPeminjaman = PeminjamanRuangan::with(['ruangan.gedung'])
            ->where('user_id', $user_id)
            ->orderBy('created_at', 'desc')
            ->get();

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
        // Validasi input
        $dataValid = $request->validate([
            'ruangan_id' => 'required',
            'kegiatan' => 'required',
            'no_peminjam' => 'required',
            'waktu_pinjam' => 'required|date',
            'waktu_selesai' => 'required|date|after_or_equal:waktu_pinjam',
        ]);

        // Periksa apakah tanggal peminjaman dan tanggal selesai adalah di masa lalu
        if (strtotime($dataValid['waktu_pinjam']) < strtotime('today') || strtotime($dataValid['waktu_selesai']) < strtotime('today')) {
            return back()->with('error', 'Tanggal peminjaman atau tanggal selesai tidak boleh di masa lalu.');
        }

        $dataValid['user_id'] = auth()->user()->id;
        $dataValid['waktu_pinjam'] = date('Y-m-d H:i', strtotime($dataValid['waktu_pinjam']));
        $dataValid['waktu_selesai'] = date('Y-m-d H:i', strtotime($dataValid['waktu_selesai']));

        // Periksa apakah ada peminjaman dengan waktu yang bertabrakan dan status 2
        $existingBooking = PeminjamanRuangan::where('ruangan_id', $dataValid['ruangan_id'])
            ->where('status', 2)
            ->where(function ($query) use ($dataValid) {
                $query->whereBetween('waktu_pinjam', [$dataValid['waktu_pinjam'], $dataValid['waktu_selesai']])
                    ->orWhereBetween('waktu_selesai', [$dataValid['waktu_pinjam'], $dataValid['waktu_selesai']])
                    ->orWhere(function ($query) use ($dataValid) {
                        $query->where('waktu_pinjam', '<=', $dataValid['waktu_pinjam'])
                            ->where('waktu_selesai', '>=', $dataValid['waktu_selesai']);
                    });
            })
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'Ruangan sudah dibooking pada tanggal dan jam yang sama. Silakan coba pada tanggal atau jam lain.');
        }

        // Buat peminjaman baru
        PeminjamanRuangan::create($dataValid);

        return redirect()->route('mahasiswa.ruangan.index')->with('success', 'Ruangan Berhasil Di Booking');
    }




    public function update(Request $request, $id)
    {
        // Validasi input
        $dataValid = $request->validate([
            'ruangan_id' => 'required',
            'kegiatan' => 'required',
            'no_peminjam' => 'required',
            'waktu_pinjam' => 'required',
            'waktu_selesai' => 'required',
        ]);

        $dataValid['user_id'] = auth()->user()->id;
        $dataValid['waktu_pinjam'] = date('Y-m-d H:i', strtotime($request->waktu_pinjam));
        $dataValid['waktu_selesai'] = date('Y-m-d H:i', strtotime($request->waktu_selesai));

        // Periksa apakah ada peminjaman dengan tanggal dan jam yang sama dan status 2, kecuali untuk booking yang sedang diedit
        $existingBooking = PeminjamanRuangan::where('ruangan_id', $dataValid['ruangan_id'])
            ->where('status', 2)
            ->where('id', '!=', decrypt($id))
            ->where(function ($query) use ($dataValid) {
                $query->whereBetween('waktu_pinjam', [$dataValid['waktu_pinjam'], $dataValid['waktu_selesai']])
                    ->orWhereBetween('waktu_selesai', [$dataValid['waktu_pinjam'], $dataValid['waktu_selesai']])
                    ->orWhere(function ($query) use ($dataValid) {
                        $query->where('waktu_pinjam', '<=', $dataValid['waktu_pinjam'])
                            ->where('waktu_selesai', '>=', $dataValid['waktu_selesai']);
                    });
            })
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'Ruangan sudah dibooking pada tanggal dan jam yang sama. Silakan coba pada tanggal atau jam lain.');
        }

        // Update data peminjaman ruangan
        PeminjamanRuangan::where('id', decrypt($id))->update($dataValid);

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
