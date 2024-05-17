<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Detailpeminjaman;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Peminjaman";
        $dataPeminjaman = Peminjaman::has('detail_peminjaman')->with('user', 'detail_peminjaman.barang')->get();

        $dataPeminjaman = Peminjaman::with('user','ruangan.gedung')->get();
        // dd($dataPeminjaman);
        return view('admin.peminjaman.data', compact(
            'title',
            'dataPeminjaman'
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Data Barang Peminjaman";
        $detailPeminjaman = Detailpeminjaman::with('barang', 'peminjaman_barang')
            ->where('pinjambarang_id', $id)
            ->get();
        // dd($detailPeminjaman);
        $view =  view('admin.peminjaman.modaldetail', compact(
            'title',
            'detailPeminjaman'
        ))->render();

        return response()->json([
            'success' => true,
            'html' => $view
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->konfirmasi, $id);
        Peminjaman::where("id", $id)->update([
            'konfirmasi' => $request->konfirmasi,
        ]);
        return redirect('admin.peminjaman.index')->with(['msg' => 'Dikonfirmasi', 'class' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
