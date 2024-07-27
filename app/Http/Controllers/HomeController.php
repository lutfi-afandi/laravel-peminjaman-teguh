<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Gedung;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Validation\Rule;
use PDF;
use File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->level == 'admin' || Auth::user()->level == 'baak') {
            $title = "Halaman Home";
            // dd(Auth::user()->level);
            $data = $this->menu();
            $halaman = 'admin.home.index';
        } else {
            $title = "Halaman Mahasiswa";
            $data = '';
            $halaman = 'mahasiswa.home.index';
        }

        return view($halaman, compact(
            'title',
            'data'
        ));
    }

    public function menu()
    {
        $jumalhRuangan = Ruangan::count();
        $jumalhGedung = Gedung::count();
        $jumalhBarang = Barang::count();
        $jml_nominal_aset = Barang::sum('harga_perolehan');
        $data = [
            'jml_ruangan'   => $jumalhRuangan,
            'jml_gedung'   => $jumalhGedung,
            'jml_aset'   => $jumalhBarang,
            'jml_nominal_aset'  => $jml_nominal_aset
        ];
        return $data;
    }

    public function profil()
    {
        $title = "Profil User";

        $user = auth()->user(); // Mengambil pengguna yang sedang login
        // dd($user);

        return view('auth.perbarui-profil', compact(
            'title',
            'user',
        ));
    }

    public function profil_update(Request $request, $id)
    {

        $dataUser = User::findOrFail(decrypt($id));

        // dd($dataUser);
        // dd($request);
        // $validatedData = $request->validate([
        //     // 'no_telepon' => 'required',
        //     'foto'      => 'image|file|max:2048'
        // ]);

        // dd($validatedData);

        // Jika email yang dimasukkan bukan milik pengguna yang sedang diupdate
        if ($request->email != $dataUser->email) {
            // Periksa apakah email sudah terpakai
            $existingEmail = User::where('email', $request->email)->first();

            // Jika email sudah digunakan dan bukan milik pengguna yang sedang diupdate
            if ($existingEmail && $existingEmail->id !== $dataUser->id) {
                return redirect()->back()->withInput()->withErrors(['email' => 'Email sudah terpakai']);
            } else {
                $validatedData['email'] = $request->email;
            }
        }


        if ($request->no_telepon != $dataUser->no_telepon) {

            $existingUser = User::where('no_telepon', $request->no_telepon)->first();
            if ($existingUser && $existingUser->id !== $dataUser->id) {
                return redirect()->back()->withInput()->withErrors(['no_telepon' => 'No Telepon sudah terpakai']);
            } else {
                $validatedData['no_telepon'] = $request->no_telepon;
            }
        }

        if ($request->file('foto')) {
            if ($dataUser->foto) {
                Storage::delete('public/users/' . $dataUser->foto);
            }
            $validatedData['foto'] = $validatedData['name'] . "-" . date('His') . "new." . $request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->storeAs('public/users', $validatedData['foto']);
        }

        // dd($validatedData);

        $dataUser->update($validatedData);

        return redirect()->route('profil')->with(['msg' => 'Data Berhasil Diubah', 'class' => 'alert-success']);
    }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    public function perbarui_password()
    {
        $title = "Perbarui Password";
        return view('auth.perbarui-password', compact('title'));
    }

    public function updatepw(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Password Lama Salah.");
        }

        if (strcmp($request->get('current-password'), $request->get('new_password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "Masukan Password Baru.");
        }
        if (!(strcmp($request->get('new_password'), $request->get('new_password_confirm'))) == 0) {
            //New password and confirm password are not same
            return redirect()->back()->with("error", "Ulangi Password Baru.");
        }

        $user = User::findorfail(Auth::user()->id);
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }
}
