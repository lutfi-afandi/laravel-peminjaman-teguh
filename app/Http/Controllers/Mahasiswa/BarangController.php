<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Detailpeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{

    public function index()
    {

        $title = 'Halaman Peminjaman Aset';
        $id = auth()->user()->id;
        $barangs = Barang::with('ruangan.gedung')->get();
        $dataPeminjaman = Peminjaman::with(['user', 'detail_peminjaman.barang'])
            ->where('user_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        // dd($dataPeminjaman);
        return view('mahasiswa.aset.index', compact(
            'title',
            'barangs',
            'dataPeminjaman'
        ));
    }


    public function show($id)
    {
    }
}
