@extends('layouts.tabler-front.master')
@section('sub-breadcrumb', $title)
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <h1 class="text-center m-b-0">Daftar Gedung</h1>
            {{-- <p class="text-center">Pilih Tanggal Peminjaman</p> --}}

        </div>
    </div>

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">

                <div class="card-header">
                    <h2 class="card-title">Silahkan Pilih Gedung : </h2>
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
                    @foreach ($gedungs as $gedung)
                        <div class="card mb-2">
                            <div class="row row-0">
                                <div class="col-3">
                                    <!-- Photo -->
                                    @if ($gedung->foto)
                                        <img src="{{ asset('storage/gedungs/' . $gedung->foto) }}"
                                            class="w-100 h-100 object-cover card-img-start" alt="{{ $gedung->foto }}">
                                    @else
                                        <img src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg"
                                            class="w-100 h-100 object-cover card-img-start" alt="{{ $gedung->nama }}">
                                    @endif
                                </div>
                                <div class="col">
                                    <div class="card-body">
                                        <h2 class="text-primary">{{ $gedung->nama }}</h2>
                                        <div class="widget-notifications-description">
                                            <strong>Lokasi</strong>:
                                            {{ $gedung->lokasi }}
                                        </div>
                                        <div class="widget-notifications-description"><strong>Jumlah Lantai</strong>:
                                            {{ $gedung->jumlah_lantai }} Lantai</div>
                                        <a href="{{ route('ruangan.byGedung', encrypt($gedung->id)) }}"
                                            class="btn btn-primary btn-pill mt-2">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-eye-search" width="44"
                                                height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path
                                                    d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                                <path d="M20.2 20.2l1.8 1.8" />
                                            </svg> Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>




            </div>
            <div class="text-center">
                {{ $gedungs->links() }}

            </div>
        </div>

    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $("#tgl_pinjam").daterangepicker();
        });
    </script>
@endpush
