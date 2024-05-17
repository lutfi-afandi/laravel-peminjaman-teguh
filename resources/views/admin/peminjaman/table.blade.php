<table class="table table-striped table-bordered " id="datatables">
    <thead style="text-align: center !important">
        <tr>
            <th width="5%">No</th>
            <th width="10%">Aksi</th>
            <th>Nama Peminjam</th>
            <th>Kegiatan</th>
            <th>Waktu</th>
            <th>Barang</th>

        </tr>
    </thead>
    <tbody>
        @php
            // dd($dataPeminjaman);
        @endphp
        {{-- {{ dd($dataPeminjaman) }} --}}
        @foreach ($dataPeminjaman as $peminjaman)
            <tr class="odd gradeX ">
                <td class="center">{{ $loop->iteration }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-info btn-outline dropdown-toggle"
                            data-toggle="dropdown" aria-expanded="false">Konfirmasi</button>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" class="bg-success btn-confirm" data-id="{{ $peminjaman->id }}"
                                    data-con="2"><i class="fa fa-check"></i>
                                    Terima</a>
                            </li>
                            <li><a href="javascript:;" class="bg-danger btn-confirm" data-id="{{ $peminjaman->id }}"
                                    data-con="3"><i class="fa fa-xmark"></i>
                                    Tolak</a></li>
                            <li><a href="javascript:;" class="bg-primary btn-confirm" data-id="{{ $peminjaman->id }}"
                                    data-con="4"><i class="fa fa-check-double"></i>
                                    Dikembalikan</a>
                            </li>
                        </ul>
                    </div>
                    <a href="https://api.whatsapp.com/send?phone={{ $peminjaman->user->no_telepon }}&text=Pesan" target="_blank" class="btn btn-sm btn-success">
                        <i class="fa fa-envelope"></i> WhatsApp
                     </a>
                </td>
                <td class="center">{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->kegiatan }}</td>
                {{-- <td>
                    <span
                        class="text-primary">{{ date('d M Y', strtotime($peminjaman->tgl_peminjaman)) . ' : ' . date('H.m', strtotime($peminjaman->jam_peminjaman)) }}
                        WIB</span> <br>
                    <span
                        class="text-success">{{ date('d M Y', strtotime($peminjaman->tgl_pengembalian)) . ' : ' . date('H.m', strtotime($peminjaman->pengembalian)) }}
                        WIB</span>
                </td> --}}

                <td>
                    <span
                        class="text-primary">{{ date('d M Y H:i', strtotime($peminjaman->waktu_peminjaman)) }}
                        WIB</span> <br>
                    <span
                        class="text-success">{{ date('d M Y H:i', strtotime($peminjaman->waktu_pengembalian)) }}
                        WIB</span>
                </td>
                
                <td>
                    <button class="badge bg-info btn-detail" id="btn-detail" data-id="{{ $peminjaman->id }}"><i
                            class="fa-solid fa-asterisk"></i> lihat
                        detail</button>

                    @switch($peminjaman->konfirmasi)
                        @case(1)
                            <small class="text-xs badge bg-secondary"><i class="fa fa-spinner fa-spin"></i> menunggu
                                konfirmasi</small>
                        @break

                        @case(2)
                            <small class="text-xs badge bg-warning"><i class="fa fa-info"></i> belum
                                dikembalikan</small>
                        @break

                        @case(3)
                            <small class="text-xs badge bg-danger"><i class="fa fa-xmark "></i> peminjaman
                                ditolak</small>
                        @break

                        @case(4)
                            <small class="text-xs badge bg-success"><i class="fa fa-check-double "></i> dikembalikan</small>
                        @break

                        @default
                    @endswitch
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
