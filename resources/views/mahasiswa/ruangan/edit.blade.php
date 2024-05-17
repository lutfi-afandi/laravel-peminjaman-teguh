@extends('templateAdminLTE/home')
@section('sub-breadcrumb', $title)
@section('content')
    <div class="row bg-white">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center m-b-0">{{ $title }}</h1>
            <p></p>
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2" style="margin-top: 8px">

        <div id="respon">
            @if (session()->has('error'))
                <div class="alert alert-warning alert-dark">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div class="panel row">
            <div class="">
                @if ($ruangan->foto_ruangan)
                    <div class="widget-products-item col-xs-12 col-sm-6 col-md-4 col-xl-3 m-b-0 p-l-0">
                        <a href="#" class="widget-products-image">
                            <img src="{{ asset('storage/ruangans/' . $ruangan->foto_ruangan) }}">
                            <span class="widget-products-overlay"></span>
                        </a>
                    </div>
                    {{-- <img src="{{ asset('storage/ruangans/' . $ruangan->foto_ruangan) }}" alt=""
                                class="rounded col-md-4" style="max-width: 250px"> --}}
                @else
                    <div class="widget-products-item col-xs-12 col-sm-6 col-md-4 col-xl-3 m-b-0 p-l-0">
                        <a href="#" class="widget-products-image">
                            <img
                                src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg">
                            <span class="widget-products-overlay"></span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="widget-notifications-item">
                    <div class="widget-notifications-title text-primary font-size-18">{{ $ruangan->nama_ruangan }}
                    </div>
                    <div class="widget-notifications-description">
                        <i class="fa fa-location-dot"></i> {{ $ruangan->gedung->nama }} - Lantai
                        {{ $ruangan->lantai }}
                    </div>
                    <div class="widget-notifications-description m-t-1"><strong>Kapasitas</strong>:
                        {{ $ruangan->kapasitas }} Orang</div>
                    <div class="widget-notifications-description"><strong>Luas</strong>:
                        {{ $ruangan->luas }} Meter&sup2;</div>
                    <div class="widget-notifications-description"><strong>Tipe</strong>:
                        {{ $ruangan->tipe }}</div>

                </div>
            </div>

            
            <form action="{{ route('mahasiswa.ruangan.update', encrypt($data->id)) }}" method="POST" id="form-peminjaman">
                @method('put')
                @csrf
                {{-- Input Hidden --}}
                <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">


                <div class="row">
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <label for="kegiatan">Kegiatan</label>
                            <input type="text" name="kegiatan" id="kegiatan" class="form-control" required
                                value="{{ old('kegiatan', $data->kegiatan) }}">
                        </fieldset>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label for="waktu_pinjam">Waktu Peminjaman</label>
                            <input type="datetime-local" name="waktu_pinjam" id="waktu_pinjam" class="form-control" required
                                value="{{ old('waktu_pinjam', $data->waktu_pinjam) }}">
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label for="waktu_selesai">Sampai Dengan</label>
                            <input type="datetime-local" name="waktu_selesai" id="waktu_selesai" class="form-control"
                                required value="{{ old('waktu_selesai', $data->waktu_selesai) }}">
                        </fieldset>
                    </div>

                </div>
                {{-- <div class="row">
                        <div class="col-md-8">
                            <fieldset class="form-group">
                                <label for="jam_pinjam">Jam Peminjaman</label>
                                <input type="datetime-local" name="jam_pinjam" id="jam_pinjam" class="form-control"
                                    required value="{{ old('jam_pinjam', $data->jam_pinjam) }}">
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label for="jam_selesai">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control"
                                    required value="{{ old('jam_selesai', $data->jam_selesai) }}">
                            </fieldset>
    
                        </div>
                    </div> --}}

        </div>
        <div class="modal-footer">
            <button type="submit" href="" class="btn btn-primary"><i class="fa fa-save"></i> Ubah</button>
        </div>


        </form>
    </div>

@endsection

@push('js')
    <script>
        setTimeout(function() {
            document.getElementById('respon').innerHTML = '';
        }, 5000);
        $(document).ready(function() {
            list_peminjaman();
        });
    </script>
@endpush
