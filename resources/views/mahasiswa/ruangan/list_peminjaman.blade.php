@extends('layouts.tabler-front.master')
@section('sub-breadcrumb', $title)
@section('content')


    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div id="respon">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dark">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Riwayat Booking : <strong>{{ auth()->user()->name }}</strong>
                    </h4>
                    <div class="card-actions">
                        <a href="/ruangan" class="btn bg-yellow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-guide"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M7 19h3a2 2 0 0 0 2 -2v-8a2 2 0 0 1 2 -2h7" />
                                <path d="M18 4l3 3l-3 3" />
                            </svg>
                            kembali
                        </a>
                    </div>

                </div>

                <div class="card-body">
                    @foreach ($listPeminjaman as $peminjaman)
                        <div class="card mt-2">
                            <div class="card-body">
                                <h2 class="widget-notifications-title text-primary">
                                    <strong>Kegiatan :</strong>
                                    {{ $peminjaman->kegiatan }}
                                </h2>
                                <div class="desk">
                                    <i class="fa fa-calendar-check"></i>
                                    <strong>Tanggal :</strong>
                                    {{ \Carbon\Carbon::parse($peminjaman->waktu_pinjam)->isoFormat('dddd, D MMMM YYYY') }}
                                </div>

                                <div class="desk">
                                    <i class="fa fa-clock"></i>
                                    <strong>Waktu :</strong>
                                    {{ date('H:i', strtotime($peminjaman->waktu_pinjam)) . ' s/d ' . date('H:i', strtotime($peminjaman->waktu_selesai)) }}
                                    WIB
                                </div>
                                <div class="desk">
                                    <i class="fa fa-building"></i>
                                    <strong>Gedung :</strong>
                                    {{ $peminjaman->ruangan->gedung->nama }}
                                </div>
                                <div class="desk">
                                    <i class="fas fa-chalkboard"></i>
                                    <strong>Ruangan :</strong>
                                    {{ $peminjaman->ruangan->nama_ruangan }} - Lantai
                                    {{ $peminjaman->ruangan->lantai }}
                                </div>
                                <div class="widget-notifications-date m-b-1">
                                    @php
                                        $bg = '';
                                        $status = '';
                                        if ($peminjaman->status == 1) {
                                            $status = 'Menunggu Konfirmasi';
                                            $bg = 'warning';
                                        } elseif ($peminjaman->status == 2) {
                                            $status = 'Dikonfirmasi/Sedang Dipinjam';
                                            $bg = 'success';
                                        } elseif ($peminjaman->status == 3) {
                                            $status = 'Ditolak';
                                            $bg = 'danger';
                                        } elseif ($peminjaman->status == 4) {
                                            $status = 'Dikembalikan';
                                            $bg = 'info';
                                        }
                                    @endphp
                                    <div class="badge bg-{{ $bg }} text-{{ $bg }}-fg"
                                        style="margin-bottom: 4px !important; margin-top: 4px !important">
                                        Status : {{ $status }}
                                    </div><br>

                                    @if ($peminjaman->status == 1)
                                        <a href="{{ route('mahasiswa.ruangan.edit', encrypt($peminjaman->id)) }}">
                                            <div class="badge bg-blue text-blue-fg" data-id="{{ $peminjaman->id }}">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </div>
                                        </a>
                                    @endif

                                    @if ($peminjaman->status == 1)
                                        <form action="{{ route('mahasiswa.ruangan.destroy', $peminjaman->id) }}"
                                            method="post" id="deleteForm" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" onclick="confirmDelete(event)"
                                                class="badge bg-danger text-danger-fg">
                                                <i class="fa fa-times"></i>
                                                hapus</button>

                                        </form>
                                    @endif

                                    @if ($peminjaman->status == 2)
                                        <a href="{{ route('mahasiswa.booking.cetak', encrypt($peminjaman->id)) }}"
                                            target="__blank" class="badge bg-secondary btn btn-add"
                                            data-id="{{ $peminjaman->id }}"><i class="fa fa-print"></i> Cetak</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>
        setTimeout(function() {
            document.getElementById('respon').innerHTML = '';
        }, 2000);
        $(document).ready(function() {
            list_peminjaman();
        });


        function confirmDelete(event) {
            // Menampilkan pesan konfirmasi
            var confirmation = confirm("Apakah Anda yakin ingin menghapus data ini?");


            if (confirmation) {
                // Lakukan submit form
                $(event.target).closest('form').submit();
            } else {
                // Batalkan aksi default klik tombol
                event.preventDefault();
            }
        }
    </script>
@endpush
