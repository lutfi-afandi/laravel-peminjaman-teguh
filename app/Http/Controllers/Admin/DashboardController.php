<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanRuangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 
        $title = "Halaman Home";
        // dd(Auth::user()->level);
        // $data = $this->menu();
        $events = [];

        $appointments = PeminjamanRuangan::with(['user', 'ruangan'])->where('status', 2)->get();
        // dd($appointments);

        foreach ($appointments as $appointment) {

            $start = new DateTime($appointment->waktu_pinjam);
            $end = new DateTime($appointment->waktu_selesai);

            // Format waktu ke format ISO8601
            $startIso = $start->format('Y-m-d\TH:i:s');
            $endIso = $end->format('Y-m-d\TH:i:s');

            $events[] = [
                'title' => $appointment->kegiatan . ' (' . $appointment->user->name . ') - ' . $appointment->ruangan->nama_ruangan,
                'start' => $startIso,
                'end' => $endIso,
            ];
        }

        $halaman = 'admin.home.index';
        return view($halaman, compact(
            'title',
            // 'data',
            'events'
        ));
    }
}
