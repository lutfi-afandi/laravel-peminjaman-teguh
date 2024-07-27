@if ($dataPeminjaman->isEmpty())
    <div class="alert alert-info" role="alert">
        <div class="d-flex">
            <div>
                <!-- Download SVG icon from http://tabler-icons.io/i/info-circle -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                    <path d="M12 9h.01"></path>
                    <path d="M11 12h1v4h1"></path>
                </svg>
            </div>
            <div>
                Data Tidak Ditemukan!
            </div>
        </div>
    </div>
@else
    @foreach ($dataPeminjaman as $peminjaman)
        <div class="card mb-2">
            <div class="card-body p-2 px-3">
                <h3 class="text-danger mb-1"><strong>Kegiatan :</strong>
                    {{ $peminjaman->kegiatan }}
                </h3>

                <div class="waktu">
                    <i class="fa fa-calendar-check"></i>
                    <strong>
                        Tanggal :
                    </strong>
                    {{ \Carbon\Carbon::parse($peminjaman->waktu_peminjaman)->isoFormat('dddd, D MMMM YYYY') . ' s/d ' . \Carbon\Carbon::parse($peminjaman->waktu_pengembalian)->isoFormat('dddd, D MMMM YYYY') }}
                </div>

                <div class="waktu-peminjaman"><i class="fa fa-clock"></i><strong>
                        Waktu :
                    </strong>{{ date('H:i', strtotime($peminjaman->waktu_peminjaman)) . ' s/d ' . date('H:i', strtotime($peminjaman->waktu_pengembalian)) }}
                </div>
                <div class="bet">
                    @php
                        $bg = '';
                        $konfirmasi = '';
                        if ($peminjaman->konfirmasi == 1) {
                            $konfirmasi = 'Menunggu Konfirmasi';
                            $bg = 'orange';
                        } elseif ($peminjaman->konfirmasi == 2) {
                            $konfirmasi = 'Dikonfirmasi/Sedang Dipinjam';
                            $bg = 'green';
                        } elseif ($peminjaman->konfirmasi == 3) {
                            $konfirmasi = 'Ditolak';
                            $bg = 'red';
                        } elseif ($peminjaman->konfirmasi == 4) {
                            $konfirmasi = 'Dikembalikan';
                            $bg = 'azure';
                        }
                    @endphp
                    <span class="badge bg-{{ $bg }} text-{{ $bg }}-fg "
                        style="margin-bottom: 4px !important; margin-top: 4px !important">
                        Status : {{ $konfirmasi }}
                    </span><br>
                    <span class="badge bg-blue text-blue-fg btn btn-detail1" data-id="{{ $peminjaman->id }}"><i
                            class="fa fa-eye"></i>
                        detail
                    </span>

                    @if ($peminjaman->konfirmasi == 1)
                        <a href="{{ route('mahasiswa.peminjaman.show', encrypt($peminjaman->id)) }}"
                            class="badge bg-green text-green-fg btn btn-add" data-id="{{ $peminjaman->id }}"><i
                                class="fa fa-plus"></i>
                            tambah</a>
                    @endif

                    @if ($peminjaman->konfirmasi == 1 || $peminjaman->konfirmasi == 3)
                        <form action="{{ route('mahasiswa.peminjaman.destroy', $peminjaman->id) }}" method="post"
                            id="deleteForm" style="display: inline-block">
                            @csrf
                            @method('delete')
                            <button type="submit" onclick="confirmDelete(event)" class="badge bg-red text-red-fg"><i
                                    class="fa fa-times"></i>
                                hapus</button>

                        </form>
                    @endif

                    @if ($peminjaman->konfirmasi == 2)
                        <a href="{{ route('mahasiswa.peminjaman.cetak', encrypt($peminjaman->id)) }}" target="__blank"
                            class="badge bg-mute  text-muted-fg btn btn-add" data-id="{{ $peminjaman->id }}"><i
                                class="fa fa-print"></i>
                            Cetak</a>
                    @endif
                </div>
                <div class="mt-1">
                    <a href="https://www.instagram.com/pustik127/" target="_blank"
                        class="badge bg-teal text-teal-fg btn ">
                        Hubungi : Pustik127 <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-brand-instagram" width="44" height="44"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" />
                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            <path d="M16.5 7.5l0 .01" />
                        </svg></a>
                </div>

                <div class="card mt-3">
                    <table class="table card-table" id="detail-table{{ $peminjaman->id }}" style="display: none">
                        <thead class="bg-blue text-blue-fg">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jumlah Barang</th>
                                <th>Lokasi Barang</th>
                            </tr>
                        </thead>

                        @foreach ($peminjaman->detail_peminjaman as $detail)
                            @if (!$detail)
                                <span class="badge bg-azure">Silahkan input barang yang ingin disimpan</span>
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
        </div>
    @endforeach

@endif

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
