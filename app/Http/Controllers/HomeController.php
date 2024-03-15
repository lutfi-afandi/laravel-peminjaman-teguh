<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Validation\Rule;
use PDF;
use File;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Auth::user()->level=='admin' || Auth::user()->level == 'baak'){
            $title = "Halaman Home";
            $halaman = 'admin.home.index';
        }else{
            $title = "Halaman Mahasiswa";
            $halaman = 'mahasiswa.home.index';
        }

        return view($halaman, compact(
            'title',
        ));
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

    public function perbarui_password() {
        $title = "Perbarui Password";
        return view('auth.perbarui-password',compact('title'));
    }

    public function updatepw(Request $request) {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Password Lama Salah.");
        }
            
        if(strcmp($request->get('current-password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Masukan Password Baru.");
        }
        if(!(strcmp($request->get('new_password'), $request->get('new_password_confirm'))) == 0){
            //New password and confirm password are not same
            return redirect()->back()->with("error","Ulangi Password Baru.");
        }

        $user = User::findorfail(Auth::user()->id);
        $user->password = Hash::make($request->get('new_password'));
        $user->save();
            
        return redirect()->back()->with("success","Password changed successfully !");
    }
}
