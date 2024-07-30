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
                    <a href="javascript:;" data-id="{{ $peminjaman->id }}" class="btn btn-info btn-sm btn-confirm mt-1">
                        <i class="fab fa-confluence"></i> Konfirmasi
                    </a>

                    <a href="https://api.whatsapp.com/send?phone={{ $peminjaman->user->no_telepon }}&text=Pesan"
                        target="_blank" class="btn btn-sm btn-success mt-1">
                        <i class="fa fa-envelope"></i> WhatsApp
                    </a>
                    <a href="{{ route('admin.peminjaman.ubah', encrypt($peminjaman->id)) }}"
                        class="btn btn-sm btn-warning mt-1">
                        <i class="fa fa-edit"></i> Ubah
                    </a>
                </td>
                <td class="center">{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->kegiatan }}</td>

                <td>
                    <span class="text-primary">
                        {{ date('d M Y H:i', strtotime($peminjaman->waktu_peminjaman)) }} WIB
                    </span> <br>
                    <span class="text-success">
                        {{ date('d M Y H:i', strtotime($peminjaman->waktu_pengembalian)) }} WIB
                    </span>
                </td>

                <td>
                    <button class="badge bg-azure text-azure-fg btn-detail mb-1" id="btn-detail"
                        data-id="{{ $peminjaman->id }}">
                        <i class="far fa-eye"></i> lihat detail
                    </button>

                    @switch($peminjaman->konfirmasi)
                        @case(1)
                            <small class="text-xs badge bg-orange  text-orange-fg"><i class="fas fa-spinner fa-spin"></i>
                                menunggu konfirmasi
                            </small>
                        @break

                        @case(2)
                            <small class="text-xs badge bg-orange  text-orange-fg""><i class="fa fa-info">
                                </i> belum dikembalikan
                            </small>
                        @break

                        @case(3)
                            <small class="text-xs badge bg-red text-red-fg"><i class="fa fa-xmark ">
                                </i> peminjaman ditolak
                            </small>
                        @break

                        @case(4)
                            <small class="text-xs badge bg-success text-green-fg">
                                <i class="fa fa-check-double "></i>
                                dikembalikan
                            </small>
                        @break

                        @default
                    @endswitch
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
@push('js')
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable();
        });
    </script>
@endpush
