@extends('templateAdminLTE/home')
@section('sub-breadcrumb', $title)
@section('content')
    <div class="row bg-white">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center m-b-0">{{ $title }}</h1>
            <p></p>
        </div>
    </div>

    <div id="tempat-modal"></div>
    <div class="row bg-white">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-black">
                <div class="panel-heading">
                    <span class="panel-title"> Peminjaman : <strong>{{ auth()->user()->name }}</strong></span>
                    <div class="panel-heading-controls">
                        <ul class="pager pager-xs">
                            <li><a href="/aset" class=" bg-warning btn-add-peminjaman"><i class="fa fa-arrow-left"></i>
                                    kembali</a>
                            <li><a type="btn" class="btn bg-primary btn-add-barang" data-toggle="modal"
                                    data-target="#modal-large">Tambah
                                    Barang +</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="widget-notifications-item">
                        <div class="widget-notifications-title text-danger font-size-18"><strong>Kegiatan :</strong>
                            {{ $dataPeminjaman->kegiatan }}
                        </div>
                        <div class="widget-notifications-description"><strong>Waktu :
                            </strong>{{ date('d-M-Y', strtotime($dataPeminjaman->tgl_dataPeminjaman)) . ' ' . $dataPeminjaman->jam_dataPeminjaman . ' s/d ' . date('d-M-Y', strtotime($dataPeminjaman->tgl_pengembalian)) . ' ' . $dataPeminjaman->jam_pengembalian }}
                        </div>
                        <div class="widget-notifications-date m-t-1">
                            @php
                                $bg = '';
                                $konfirmasi = '';
                                if ($dataPeminjaman->konfirmasi == 1) {
                                    $konfirmasi = 'Menunggu Konfirmasi';
                                    $bg = 'warning';
                                } elseif ($dataPeminjaman->konfirmasi == 2) {
                                    $konfirmasi = 'Dikonfirmasi/Sedang Dipinjam';
                                    $bg = 'success';
                                } elseif ($dataPeminjaman->konfirmasi == 3) {
                                    $konfirmasi = 'Ditolak';
                                    $bg = 'danger';
                                } elseif ($dataPeminjaman->konfirmasi == 4) {
                                    $konfirmasi = 'Dikembalikan';
                                    $bg = 'info';
                                }
                            @endphp
                            <div class="badge bg-{{ $bg }}">Status : {{ $konfirmasi }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-10 col-md-offset-1">
            <div class="panel ">
                <div id="respon">
                    @if (session()->has('msg'))
                        <div class="alert {{ session('class') }} alert-dark">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            {{ session('msg') }}
                        </div>
                    @endif
                </div>
                <div class="panel-body">
                    <div class="detail-peminjaman">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-large" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Pilih Barang</h4>
                </div>

                <div class="modal-body">
                    <form action="{{ route('mahasiswa.detailpeminjaman.store') }}" id="form-add-barang" method="post">
                        @csrf
                        <input type="hidden" name="pinjambarang_id" id="pinjambarang_id" value="{{ $dataPeminjaman->id }}">

                        <fieldset class="form-group">
                            <label for="barang_id">Barang</label>
                            <select name="barang_id" id="barang_id" class="form-control" required>
                                <option value="" hidden>Pilih Barang</option>
                                @foreach ($barangs as $barang)
                                    <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                @endforeach
                            </select>
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="jml_barang">Jumlah Barang</label>
                            <input type="text" class="form-control" name="jml_barang" id="jml_barang" required>
                        </fieldset>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('js')
    <script>
        $(document).ready(function() {
            list_barang();
        });

        $('.btn-iseng').click(function(e) {
            e.preventDefault();
            list_barang();
        });

        function list_barang() {
            var id = '{{ $dataPeminjaman->id }}';
            var url = "{{ route('mahasiswa.peminjaman.getbarang', ':peminjaman_id') }}";
            url = url.replace(":peminjaman_id", id);
            $.ajax({
                    method: "GET",
                    url: url,
                })
                .done(function(data) {
                    $('.detail-peminjaman').html(data.html);
                })
        }

        setTimeout(function() {
            document.getElementById('respon').innerHTML = '';
        }, 2000);
    </script>
@endpush
