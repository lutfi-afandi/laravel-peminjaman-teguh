<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\PeminjamanRuangan;
use DateTime;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Jadwal';
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

        // dd($events);

        return view('admin.jadwal.index', compact('title', 'events'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
}
