@foreach ($dataPeminjaman as $peminjaman)
    <div class="widget-notifications-item">
        <div class="widget-notifications-title text-danger font-size-16"><strong>Kegiatan :</strong>
            {{ $peminjaman->kegiatan }}
        </div>

        <div class="widget-notifications-description font-size-12">
            <i class="fa-regular fa-calendar-check"></i>
            <strong>
                Tanggal :
            </strong>
            {{ \Carbon\Carbon::parse($peminjaman->waktu_peminjaman)->isoFormat('dddd, D MMMM YYYY') . ' s/d '. \Carbon\Carbon::parse($peminjaman->waktu_pengembalian)->isoFormat('dddd, D MMMM YYYY')}}
        </div>

        <div class="widget-notifications-description  font-size-12"><i class="fa-regular fa-clock"></i><strong>
                Waktu :
            </strong>{{ date('H:i', strtotime($peminjaman->waktu_peminjaman)) . ' s/d ' . date('H:i', strtotime($peminjaman->waktu_pengembalian)) }}
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
            
            @if ($peminjaman->konfirmasi == 1)
            <a href="{{ route('mahasiswa.peminjaman.show', encrypt($peminjaman->id)) }}" class="badge bg-success btn btn-add"
                data-id="{{ $peminjaman->id }}"><i class="fa fa-plus"></i> tambah</a>
            @endif

            @if ($peminjaman->konfirmasi == 1 || $peminjaman->konfirmasi == 3)
            <form action="{{ route('mahasiswa.peminjaman.destroy', $peminjaman->id) }}" method="post" id="deleteForm"
                style="display: inline-block">
                @csrf
                @method('delete')
                <button type="submit" onclick="confirmDelete(event)" class="badge bg-danger"><i class="fa fa-times"></i>
                    hapus</button>

            </form>
            @endif

            @if ($peminjaman->konfirmasi == 2)
            <a href="{{ route('mahasiswa.peminjaman.cetak', encrypt($peminjaman->id)) }}" target="__blank" class="badge bg-secondary btn btn-add"
                data-id="{{ $peminjaman->id }}"><i class="fa fa-print"></i> Cetak</a>
            @endif
        </div>


        <table class="table" id="detail-table{{ $peminjaman->id }}" style="display: none">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Lokasi Barang</th>
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
                            <td>{{ $detail->barang->ruangan->nama_ruangan }}</td>
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
