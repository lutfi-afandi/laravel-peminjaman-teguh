<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $title = 'Halaman Ruangan';
        $ruangans = Ruangan::with('gedung')->paginate(2);
        return view('mahasiswa.ruangan.index', compact(
            'title',
            'ruangans',
        ));
    }

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
}
