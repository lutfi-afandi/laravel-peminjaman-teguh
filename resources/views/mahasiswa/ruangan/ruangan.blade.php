@extends('layouts.tabler-front.master')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <h1 class="text-center m-b-0">Daftar Ruangan</h1>
            {{-- <p class="text-center">Pilih Tanggal Peminjaman</p> --}}

        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">


            <div class="card ">

                <div class="card-header">
                    <h2 class="card-title">Silahkan Pilih Ruangan : </h2>
                    <div class="card-actions">
                        <a href="{{ route('mahasiswa.ruangan.index') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-history-toggle"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 20.777a8.942 8.942 0 0 1 -2.48 -.969" />
                                <path d="M14 3.223a9.003 9.003 0 0 1 0 17.554" />
                                <path d="M4.579 17.093a8.961 8.961 0 0 1 -1.227 -2.592" />
                                <path d="M3.124 10.5c.16 -.95 .468 -1.85 .9 -2.675l.169 -.305" />
                                <path d="M6.907 4.579a8.954 8.954 0 0 1 3.093 -1.356" />
                                <path d="M12 8v4l3 3" />
                            </svg> Riwayat Peminjaman
                        </a>
                        <a href="{{ route('aset') }}" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-guide"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M7 19h3a2 2 0 0 0 2 -2v-8a2 2 0 0 1 2 -2h7" />
                                <path d="M18 4l3 3l-3 3" />
                            </svg>
                            Peminjaman Barang
                        </a>

                    </div>
                </div>

                <div class="card-body">
                    @foreach ($ruangans as $ruangan)
                        <div class="card mb-2">
                            <div class="row row-0">
                                <div class="col-3">
                                    <!-- Photo -->
                                    @if ($ruangan->foto_ruangan)
                                        <img src="{{ asset('storage/ruangans/' . $ruangan->foto_ruangan) }}"
                                            class="w-100 h-100 object-cover card-img-start"
                                            alt="{{ $ruangan->foto_ruangan }}">
                                    @else
                                        <img src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg"
                                            class="w-100 h-100 object-cover card-img-start"
                                            alt="{{ $ruangan->nama_ruangan }}">
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h2 class="text-primary">Ruangan : {{ $ruangan->nama_ruangan }}</h2>
                                        <div class="widget-notifications-description">
                                            <strong>Lokasi</strong>:
                                            <i class="fa fa-location"></i> {{ $ruangan->gedung->nama }} - Lantai
                                            {{ $ruangan->lantai }}
                                        </div>
                                        <div class="widget-notifications-description "><strong>Kapasitas</strong>:
                                            {{ $ruangan->kapasitas }} Orang
                                        </div>
                                        <div class="widget-notifications-description"><strong>Luas</strong>:
                                            {{ $ruangan->luas }} Meter&sup2;
                                        </div>
                                        <div class="widget-notifications-description"><strong>Tipe</strong>:
                                            {{ $ruangan->tipe }}
                                        </div>
                                        <a href="{{ route('mahasiswa.ruangan.show', encrypt($ruangan->id)) }}"
                                            class="btn btn-primary btn-sm "><i class="fas fa-bookmark"></i> Booking</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center mt-3">
                        {{ $ruangans->links() }}
                    </div>
                </div>
            </div>
            {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $("#tgl_pinjam").daterangepicker();
        });
    </script>
    <script>
        $(document).ready(function() {
            list_ruangan()
        });


        function list_ruangan() {
            var url = '{{ route('ruangan.get') }}';
            $.ajax({
                    method: "GET",
                    url: url,
                })
                .done(function(data) {
                    // $('#list-ruangan').html(data.html);
                })
        }
    </script>
@endpush
