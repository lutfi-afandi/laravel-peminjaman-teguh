<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanRuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    public function index()
    {
        $title = "Data Booking";

        if (Auth::user()->level == 'admin') {
            $dataBooking = PeminjamanRuangan::with(['user', 'ruangan.gedung'])->get();
        } elseif (Auth::user()->level == 'baak') {
            $dataBooking = PeminjamanRuangan::with(['user', 'ruangan.gedung'])
                ->whereHas('ruangan', function ($query) {
                    $query->where('unit_kerja_id', Auth::user()->unitkerja_id);
                })
                ->get();
        }

        return view('admin.booking.data', compact(
            'title',
            'dataBooking'
        ));
    }



    public function laporan()
    {
        $title = "Laporan";
        
        return view('admin.booking.laporan', compact(
            'title',
        ));
    }

    public function fetchDataLaporan(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Query untuk mengambil data sesuai rentang waktu
        
        $query = PeminjamanRuangan::with('ruangan', 'user')
            ->whereBetween('waktu_pinjam', [$startDate, $endDate]);


        // Jika status dipilih, tambahkan kondisi where untuk status
        if ($request->has('status')) {
            $status = $request->status;
            $query->where('status', $status);
        }

        // Ambil data sesuai query
        $dataPeminjaman = $query->get();

        return response()->json($dataPeminjaman);
    }



public function cetakLaporan(Request $request)
{
    $title = "Cetak Laporan";
    // Validasi input
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $startDate = $request->start_date;
    $endDate = $request->end_date;

    // Query untuk mengambil data sesuai rentang waktu
    $query = PeminjamanRuangan::with('ruangan', 'user')
        ->whereBetween('waktu_pinjam', [$startDate, $endDate]);

    // Jika status dipilih, tambahkan kondisi where untuk status
    if ($request->has('status')) {
        $status = $request->status;
        $query->where('status', $status);
    }

    // Ambil data sesuai query
    $dataPeminjaman = $query->get();

    return view('admin.booking.cetakLaporan', compact(
        'title', 'dataPeminjaman'
    ));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PeminjamanRuangan  $peminjamanRuangan
     * @return \Illuminate\Http\Response
     */
    public function show(PeminjamanRuangan $peminjamanRuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PeminjamanRuangan  $peminjamanRuangan
     * @return \Illuminate\Http\Response
     */
    public function edit(PeminjamanRuangan $peminjamanRuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PeminjamanRuangan  $peminjamanRuangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->konfirmasi, $id);
        PeminjamanRuangan::where("id", $id)->update([
            'status' => $request->konfirmasi,
        ]);
        return redirect('admin.booking.index')->with(['msg' => 'Dikonfirmasi', 'class' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PeminjamanRuangan  $peminjamanRuangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PeminjamanRuangan $peminjamanRuangan)
    {
        //
    }
}
