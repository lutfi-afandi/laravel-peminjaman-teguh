@extends('layouts.tabler-front.master')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <h1 class="text-center m-b-0">{{ $title }}</h1>
            <p></p>
        </div>

        <div id="respon">
            @if (session()->has('error'))
                <div class="alert alert-warning alert-dark">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        <div class="card">
            <div class="card-body">
                <div class="card mb-2">
                    <div class="row row-0">
                        <div class="col-3">
                            @if ($ruangan->foto_ruangan)
                                <img src="{{ asset('storage/ruangans/' . $ruangan->foto_ruangan) }}"
                                    class="w-100 h-100 object-cover card-img-start">
                            @else
                                <img src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg"
                                    class="w-100 h-100 object-cover card-img-start">
                            @endif
                        </div>
                        <div class="col">
                            <div class="card-body">
                                <div class="widget-notifications-item">
                                    <h2 class="widget-notifications-title text-primary font-size-18">
                                        <strong>Ruangan </strong>: {{ $ruangan->nama_ruangan }}
                                    </h2>
                                    <div class="widget-notifications-description"><strong>Lokasi</strong>:
                                        <i class="fa fa-location"></i> {{ $ruangan->gedung->nama }} - Lantai
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
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-blue-fg">
                        <strong>Lengkapi Data</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('mahasiswa.ruangan.update', encrypt($data->id)) }}" method="POST"
                            id="form-peminjaman">
                            @method('put')
                            @csrf
                            {{-- Input Hidden --}}
                            <input type="hidden" name="ruangan_id" value="{{ $ruangan->id }}">
                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <fieldset class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            value="{{ auth()->user()->name }}" disabled>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="form-group">
                                        <label for="username">NPM</label>
                                        <input type="text" name="username" id="username" class="form-control"
                                            value="{{ auth()->user()->username }}" disabled>
                                    </fieldset>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="form-group">
                                        <label for="no_peminjam">No WA</label>
                                        <input type="text" name="no_peminjam" id="no_peminjam" class="form-control"
                                            value="{{ old('no_peminjam', $data->no_peminjam) }}" autofocus>
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <fieldset class="form-group">
                                        <label for="kegiatan">Kegiatan</label>
                                        <input type="text" name="kegiatan" id="kegiatan" class="form-control" required
                                            value="{{ old('kegiatan', $data->kegiatan) }}">
                                    </fieldset>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="waktu_pinjam">Waktu Peminjaman</label>
                                        <input type="datetime-local" name="waktu_pinjam" id="waktu_pinjam"
                                            class="form-control" required
                                            value="{{ old('waktu_pinjam', $data->waktu_pinjam) }}">
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <fieldset class="form-group">
                                        <label for="waktu_selesai">Sampai Dengan</label>
                                        <input type="datetime-local" name="waktu_selesai" id="waktu_selesai"
                                            class="form-control" required
                                            value="{{ old('waktu_selesai', $data->waktu_selesai) }}">
                                    </fieldset>
                                </div>

                            </div>


                            <button type="submit" href="" class="btn btn-primary mt-2"><i class="fa fa-save"></i>
                                Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
