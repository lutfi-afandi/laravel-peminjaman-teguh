<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Ruangan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <!-- Logo Instansi -->
        <div class="row">
            <div class="col-12">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Instansi" class="img-fluid" style="max-width: 200px;">
            </div>
        </div>

        <!-- Head Judul View -->
        <div class="row mt-4">
            <div class="col-12 text-center">
                <h1>Laporan Peminjaman Ruangan</h1>
            </div>
        </div>
    </div>

    <!-- Tabel Data Peminjaman -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peminjam</th>
                                <th>No Hp</th>
                                <th>Ruangan</th>
                                <th>Kegiatan</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataPeminjaman as $index => $peminjaman)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->user->no_telepon }}</td>
                                    <td>{{ $peminjaman->ruangan->nama_ruangan }}</td>
                                    <td>{{ $peminjaman->kegiatan }}</td>
                                    <td>
                                        <span>{{ \Carbon\Carbon::parse($peminjaman->waktu_pinjam)->isoFormat('dddd, D MMMM YYYY') }}</span> <br>
                                        <span>{{ date('H:i', strtotime($peminjaman->waktu_pinjam)) . ' s/d ' . date('H:i', strtotime($peminjaman->waktu_selesai)) }} WIB</span> <br>
                                    </td>
                                    <td>
                                        @switch($peminjaman->status)
                                            @case(1)
                                                Menunggu Konfirmasi
                                            @break

                                            @case(2)
                                                Dikonfirmasi/Dipinjam
                                            @break

                                            @case(3)
                                                Ditolak
                                            @break

                                            @case(4)
                                                Dikembalikan
                                            @break

                                            @default
                                                Unknown
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    window.onload = function () {
        window.print();
    };
</script>
</html>
