@extends('templateAdminLTE/home')
@section('sub-breadcrumb', $title)
@section('content')


    <div class="row bg-white">
        <div class="col-md-8 col-md-offset-2">
            <div id="respon">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dark">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="panel panel-black">
                <div class="panel-heading">
                    <span class="panel-title">Riwayat Booking : <strong>{{ auth()->user()->name }}</strong></span>

                </div>
                <div class="table-light">
                    @foreach ($listPeminjaman as $peminjaman)
                        <div class="widget-notifications-item">
                            <div class="widget-notifications-title text-danger font-size-16"><strong>Kegiatan :</strong>
                                {{ $peminjaman->kegiatan }}
                            </div>
                            <div class="widget-notifications-description font-size-12">
                                <i class="fa-regular fa-calendar-check"></i>
                                <strong>
                                    Tanggal :
                                </strong>
                                {{ \Carbon\Carbon::parse($peminjaman->waktu_pinjam)->isoFormat('dddd, D MMMM YYYY') }}
                            </div>

                            <div class="widget-notifications-description  font-size-12"><i
                                    class="fa-regular fa-clock"></i><strong>
                                    Waktu :
                                </strong>{{ date('H:i', strtotime($peminjaman->waktu_pinjam)) . ' s/d ' . date('H:i', strtotime($peminjaman->waktu_selesai)) }}
                                WIB
                            </div>
                            <div class="widget-notifications-description  font-size-12"><i class="fa-solid fa-building"></i>
                                <strong>
                                    Gedung :
                                </strong>{{ $peminjaman->ruangan->gedung->nama }}
                            </div>
                            <div class="widget-notifications-description  font-size-12"><i
                                    class="fa-solid fa-location-dot"></i> <strong>
                                    Ruangan :
                                </strong>{{ $peminjaman->ruangan->nama_ruangan }} || Lantai
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
                                <div class="badge bg-{{ $bg }} "
                                    style="margin-bottom: 4px !important; margin-top: 4px !important">
                                    Status : {{ $status }}
                                </div><br>

                                @if ($peminjaman->status == 1)
                                    <a href="{{ route('mahasiswa.ruangan.edit',encrypt($peminjaman->id)) }}">
                                        <div class="badge bg-primary" data-id="{{ $peminjaman->id }}"><i
                                                class="fa fa-edit"></i>
                                            Edit
                                        </div>
                                    </a>
                                @endif


                                {{-- @if ($peminjaman->status == 1)
                                    <a href="{{ route('mahasiswa.peminjaman.show', $peminjaman->id) }}"
                                        class="badge bg-success btn btn-add" data-id="{{ $peminjaman->id }}"><i
                                            class="fa fa-plus"></i> tambah</a>
                                @endif --}}

                                @if ($peminjaman->status == 1)
                                    <form action="{{ route('mahasiswa.ruangan.destroy', $peminjaman->id) }}" method="post"
                                        id="deleteForm" style="display: inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" onclick="confirmDelete(event)" class="badge bg-danger"><i
                                                class="fa fa-times"></i>
                                            hapus</button>

                                    </form>
                                @endif



                                {{-- @if ($peminjaman->status == 2)
                                    <a href="{{ route('mahasiswa.booking.cetak', encrypt($peminjaman->id)) }}"
                                        target="__blank" class="badge bg-secondary btn btn-add"
                                        data-id="{{ $peminjaman->id }}"><i class="fa fa-print"></i> Cetak</a>
                                @endif --}}

                                @if ($peminjaman->status == 2)
                                    <a href="{{ route('mahasiswa.booking.cetak', encrypt($peminjaman->id)) }}"
                                        target="__blank" class="badge bg-secondary btn btn-add"
                                        data-id="{{ $peminjaman->id }}"><i class="fa fa-print"></i> Cetak</a>
                                @endif

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
