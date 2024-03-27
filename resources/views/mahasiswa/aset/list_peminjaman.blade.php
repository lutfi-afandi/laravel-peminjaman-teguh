@foreach ($dataPeminjaman as $peminjaman)
    <div class="widget-notifications-item">
        <div class="widget-notifications-title text-danger font-size-16"><strong>Kegiatan :</strong>
            {{ $peminjaman->kegiatan }}
        </div>
        <div class="widget-notifications-description  font-size-12"><i class="fa-regular fa-calendar-check"></i><strong>
                Waktu :
            </strong>{{ date('d-M-Y', strtotime($peminjaman->tgl_peminjaman)) . ' ' . $peminjaman->jam_peminjaman . ' s/d ' . date('d-M-Y', strtotime($peminjaman->tgl_pengembalian)) . ' ' . $peminjaman->jam_pengembalian }}
        </div>
        <div class="widget-notifications-description  font-size-12"><i class="fa-solid fa-location-dot"></i> <strong>
                Tempat :
            </strong>{{ $peminjaman->ruangan->nama_ruangan }}
        </div>
        <div class="widget-notifications-date m-b-1">
            @php
                $bg = '';
                $konfirmasi = '';
                if ($peminjaman->konfirmasi == 1) {
                    $konfirmasi = 'Menunggu Konfirmasi';
                    $bg = 'warning';
                } elseif ($peminjaman->konfirmasi == 2) {
                    $konfirmasi = 'Dikonfirmasi/Sedang Dipinjam';
                    $bg = 'success';
                } elseif ($peminjaman->konfirmasi == 3) {
                    $konfirmasi = 'Ditolak';
                    $bg = 'danger';
                } elseif ($peminjaman->konfirmasi == 4) {
                    $konfirmasi = 'Dikembalikan';
                    $bg = 'info';
                }
            @endphp
            <div class="badge bg-{{ $bg }} " style="margin-bottom: 4px !important; margin-top: 4px !important">
                Status : {{ $konfirmasi }}
            </div><br>
            <div class="badge bg-primary btn btn-detail1" data-id="{{ $peminjaman->id }}"><i class="fa fa-eye"></i>
                detail
            </div>
            <a href="{{ route('mahasiswa.peminjaman.show', $peminjaman->id) }}" class="badge bg-success btn btn-add"
                data-id="{{ $peminjaman->id }}"><i class="fa fa-plus"></i> tambah</a>

            <form action="{{ route('mahasiswa.peminjaman.destroy', $peminjaman->id) }}" method="post"
                style="display: inline-block">
                @csrf
                @method('delete')
                <button type="submit" class="badge bg-danger"><i class="fa fa-times"></i> hapus</button>
                {{-- <a href="#" type="button" class="badge bg-danger btn btn-delete"
                    data-id="{{ $peminjaman->id }}"><i class="fa fa-times"></i>
                    hapus</a> --}}
            </form>
        </div>


        <table class="table" id="detail-table{{ $peminjaman->id }}" style="display: none">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                </tr>
            </thead>

            @foreach ($peminjaman->detail_peminjaman as $detail)
                @if (!$detail)
                    <span class="badge bg-info">Silahkan input barang yang ingin disimpan</span>
                @else
                    <tbody>
                        <tr>
                            <td>{{ $detail->barang->nama }}</td>
                            <td>{{ $detail->jml_barang }}</td>
                        </tr>
                    </tbody>
                @endif
            @endforeach
        </table>


    </div>
@endforeach

<script>
    $('.btn-detail1').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        $('#detail-table' + id).slideToggle();

    });
</script>
