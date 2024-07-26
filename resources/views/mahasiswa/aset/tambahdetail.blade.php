@extends('layouts.tabler-front.master')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <h1 class="text-center m-b-0">{{ $title }}</h1>
            {{-- <p class="text-center">Pilih Tanggal Peminjaman</p> --}}

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <span class="card-title"> Peminjaman : <strong>{{ auth()->user()->name }}</strong></span>
                    <div class="card-actions">
                        <a href="/aset" class="btn bg-orange text-orange-fg btn-add-peminjaman"><i
                                class="fa fa-arrow-left"></i> Kembali</a>
                        <a type="btn" class="btn bg-blue text-blue-fg" data-bs-toggle="modal"
                            data-bs-target="#modal-large"><i class="fa fa-plus"></i> Tambah Barang</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-body p-2 px-3">
                        <h3 class="text-danger mb-1"><strong>Kegiatan :</strong>
                            {{ $dataPeminjaman->kegiatan }}
                        </h3>

                        <div class="waktu">
                            <i class="fa fa-calendar-check"></i>
                            <strong>
                                Tanggal :
                            </strong>
                            {{ \Carbon\Carbon::parse($dataPeminjaman->waktu_peminjaman)->isoFormat('dddd, D MMMM YYYY') . ' s/d ' . \Carbon\Carbon::parse($dataPeminjaman->waktu_pengembalian)->isoFormat('dddd, D MMMM YYYY') }}
                        </div>

                        <div class="waktu-peminjaman"><i class="fa fa-clock"></i><strong>
                                Waktu :
                            </strong>{{ date('H:i', strtotime($dataPeminjaman->waktu_peminjaman)) . ' s/d ' . date('H:i', strtotime($dataPeminjaman->waktu_pengembalian)) }}
                        </div>
                        <div class="bet">
                            @php
                                $bg = '';
                                $konfirmasi = '';
                                if ($dataPeminjaman->konfirmasi == 1) {
                                    $konfirmasi = 'Menunggu Konfirmasi';
                                    $bg = 'orange';
                                } elseif ($dataPeminjaman->konfirmasi == 2) {
                                    $konfirmasi = 'Dikonfirmasi/Sedang Dipinjam';
                                    $bg = 'green';
                                } elseif ($dataPeminjaman->konfirmasi == 3) {
                                    $konfirmasi = 'Ditolak';
                                    $bg = 'red';
                                } elseif ($dataPeminjaman->konfirmasi == 4) {
                                    $konfirmasi = 'Dikembalikan';
                                    $bg = 'azure';
                                }
                            @endphp
                            <span class="badge bg-{{ $bg }} text-{{ $bg }}-fg "
                                style="margin-bottom: 4px !important; margin-top: 4px !important">
                                Status : {{ $konfirmasi }}
                            </span><br>

                            @if ($dataPeminjaman->konfirmasi == 2)
                                <a href="{{ route('mahasiswa.peminjaman.cetak', encrypt($dataPeminjaman->id)) }}"
                                    target="__blank" class="badge bg-secondary btn btn-add"
                                    data-id="{{ $dataPeminjaman->id }}"><i class="fa fa-print"></i>
                                    Cetak</a>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table class="table table-vcenter " id="detail-table{{ $dataPeminjaman->id }}"
                                style="display: none">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang</th>
                                        <th>Lokasi Barang</th>
                                    </tr>
                                </thead>

                                @foreach ($dataPeminjaman->detail_peminjaman as $detail)
                                    @if (!$detail)
                                        <span class="badge bg-info">Silahkan input barang yang ingin disimpan</span>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td>{{ $detail->barang->nama }}</td>
                                                <td>{{ $detail->jml_barang }}</td>
                                                <td>{{ $detail->barang->ruangan->nama_ruangan }}</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                @endforeach
                            </table>
                        </div>



                    </div>
                    {{-- daftar barang yang di booking --}}
                    <div id="respon" class=" mb-2">
                        @if (session()->has('msg'))
                            <div class="alert alert-important alert {{ session('class') }} alert-dismissible"
                                role="alert">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-info-hexagon" width="44" height="44"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                                            <path d="M12 9h.01" />
                                            <path d="M11 12h1v4h1" />
                                        </svg>
                                    </div>
                                    <div>
                                        {{ session('msg') }}
                                    </div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                        @endif
                    </div>
                    <div class="card ">


                        <div class="detail-peminjaman">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    <div class="modal fade" id="modal-large" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Barang</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('mahasiswa.detailpeminjaman.store') }}" id="form-add-barang" method="post">
                        @csrf
                        <input type="hidden" name="pinjambarang_id" id="pinjambarang_id"
                            value="{{ $dataPeminjaman->id }}">

                        <fieldset class="form-group mb-2">
                            <label class="form-label">Barang</label>
                            <select name="barang_id" id="select-people" class="form-select" required>
                                <option value="" hidden>Pilih Barang</option>
                                @foreach ($barangs as $barang)
                                    @php
                                        $file = asset('storage/barangs/' . $barang->foto);
                                    @endphp
                                    <option value="{{ $barang->id }}"
                                        data-custom-properties="&lt;span class=&quot;avatar avatar-xs&quot; style=&quot;background-image: url('{{ $file }}')&quot;&gt;&lt;/span&gt;">
                                        {{ $barang->nama }} -
                                        {{ $barang->penanggung_jawab }}</option>
                                @endforeach
                            </select>
                        </fieldset>

                        <fieldset class="form-group">
                            <label class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" name="jml_barang" id="jml_barang" required>
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



        // $(function() {
        //     // Initialize Select2 select box
        //     $('#barang_id').select2({
        //         dropdownParent: $('#modal-large'),
        //         placeholder: 'Pilih Barang....',
        //     }).change(function() {
        //         $(this).valid();
        //     });
        // });
    </script>
    <script>
        // @formatter:off
        document.addEventListener("DOMContentLoaded", function() {
            var el;
            window.TomSelect && (new TomSelect(el = document.getElementById('select-people'), {
                copyClassesToDropdown: false,
                dropdownParent: 'body',
                controlInput: '<input>',
                render: {
                    item: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                    option: function(data, escape) {
                        if (data.customProperties) {
                            return '<div><span class="dropdown-item-indicator">' + data
                                .customProperties + '</span>' + escape(data.text) + '</div>';
                        }
                        return '<div>' + escape(data.text) + '</div>';
                    },
                },
            }));
        });
        // @formatter:on
    </script>
@endpush
