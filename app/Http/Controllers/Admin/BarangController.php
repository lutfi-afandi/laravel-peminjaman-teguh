<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Data Barang";
        $dataBarang = Barang::with('ruangan.gedung')->get();
        // dd($dataBarang);
        return view('admin.barang.data', compact(
            'title',
            'dataBarang'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Tambah Data Barang";
        $ruangans = Ruangan::with('gedung')->get();
        $kategoris = Kategori::all();
        return  view('admin.barang.create', compact(
            'title',
            'ruangans',
            'kategoris'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tgl_perolehan = date('Y-m-d', strtotime($request->tgl_perolehan));
        // dd($tgl_perolehan);

        $validatedData  = $request->validate([
            'nama'     => 'required|max:255',
            'kode'     => 'required|unique:gedungs',
            "kategori_id" => 'required',
            "tgl_perolehan" => '',
            "ruangan_id" => 'required',
            "penanggung_jawab" => 'required',
            "harga_perolehan" => '',
            "jumlah" => '',
            "kondisi" => 'required',
            "status" => 'required',
            "deskripsi" => 'required',
            'foto' => 'image|file|max:2048',
        ]);

        $validatedData['tgl_perolehan'] = $tgl_perolehan;
        if ($request->file('foto')) {
            $validatedData['foto'] = $validatedData['kode'] . "-" . date('His') . "." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('public/barangs', $validatedData['foto']);
        }
        Barang::create($validatedData);
        // dd();
        return redirect()->route('admin.barang.index')->with(['msg' => 'Data Berhasil Disimpan', 'class' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = "Hapus Barang";
        $dataBarang = Barang::where("id", $id)->first();
        $view = view('admin.barang.delete', compact('title', 'dataBarang'))->render();
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
        $title = "Tambah Data Barang";
        $ruangans = Ruangan::with('gedung')->get();
        $dataBarang = Barang::where('id', $id)->first();
        $kategoris = Kategori::all();
        return  view('admin.barang.update', compact(
            'title',
            'dataBarang',
            'ruangans',
            'kategoris'
        ));
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
        $dataBarang = Barang::where("id", $id)->first();
        $validatedData  = $request->validate([
            'nama'     => 'required|max:255',
            "kategori_id" => '',
            "tgl_perolehan" => '',
            "ruangan_id" => 'required',
            "penanggung_jawab" => 'required',
            "harga_perolehan" => '',
            "jumlah" => '',
            "kondisi" => 'required',
            "status" => '',
            "deskripsi" => 'required',
            'foto' => 'image|file|max:2048',
        ]);
        $validatedData['tgl_perolehan'] = date('Y-m-d', strtotime($request->tgl_perolehan));
        if ($request->file('foto')) {
            // dd(Storage::exists($path));
            if ($dataBarang->foto) {
                Storage::delete('public/barangs/' . $dataBarang->foto);
            }
            $validatedData['foto'] = $validatedData['nama'] . "-" . date('His') . "new." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('public/barangs', $validatedData['foto']);
        }

        Barang::where('id', $id)->update($validatedData);
        // dd();
        return redirect()->route('admin.barang.index')->with(['msg' => 'Berhasil Mengubah Data', 'class' => 'alert-success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        if ($barang->foto) {
            Storage::delete('public/barangs/' . $barang->foto);
        }
        Barang::where("id", $barang->id)->delete();
        return back()->with(['msg' => 'Berhasil Menghapus Data', 'class' => 'alert-success']);
    }
}
