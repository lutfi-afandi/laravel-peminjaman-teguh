@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Halaman Mahasiswa')
@section('content')
    <div class="row ">
        <div class="col-md-12">
            <div class="box p-5 bg-black">
                <div class="col-md-6">
                    <div class="panel bg-black m-b-0">
                        <img src="https://radarlampung.disway.id/upload/2f4af8781547a9d7097a689dd61e4e4e.jpg" alt=""
                            class="image" style="width: 100%">
                    </div>
                </div>
                <div class="col-md-6">
                    <h2>Pilih Peminjaman</h2>
                    <div class="panel bg-black m-t-4 panel-dark">
                        <a href="{{ route('aset') }}" class="font-size-24">
                            <div class="panel-body">
                                <i class="fa fa-boxes-stacked"></i>
                                Aset
                            </div>
                        </a>
                    </div>
                    <div class="panel bg-black m-t-4 panel-dark">
                        <a href="/ruangan" class="font-size-24">
                            <div class="panel-body">
                                <i class="fa-brands fa-chromecast"></i>
                                Ruangan
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
