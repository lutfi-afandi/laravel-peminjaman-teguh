<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=1">
    <title>Cetak Peminjaman Ruangan</title>

    <style>
        /* Style untuk kontainer */
        .container {
            position: relative;
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }

        .qr-code {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        /* Style untuk judul */
        h1 {
            text-align: center;
        }

        /* Style untuk tabel */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Style untuk data */
        .data {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .data > div {
            width: 48%;
        }

        .data p {
            margin: 0;
            display: flex;
            align-items: center;
        }

        .data p strong {
            width: 120px;
            display: inline-block;
        }
       
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <div style="text-align: center;">
            <img src="{{ asset('img/Tekno.png') }}" alt="Logo" width="100">
        </div>
        
        <!-- Judul -->
        <h1>Peminjaman Ruangan</h1>
        
        <!-- Data -->
        <div class="data">
            <div>
                <p><strong>Hari</strong>: {{ \Carbon\Carbon::parse($dataBooking->waktu_pinjam)->isoFormat('dddd, D MMMM YYYY') }}</p>
                <p><strong>Waktu</strong>:  <span
                    class="text-primary">{{ date('H:i', strtotime($dataBooking->waktu_pinjam)) . ' s/d ' . date('H:i', strtotime($dataBooking->waktu_selesai)) }} WIB</span> <br></p>
                <p><strong>Ruangan</strong>: {{ $dataBooking->ruangan->nama_ruangan }}</p>
               
                <p><strong>Kegiatan</strong>: {{ $dataBooking->kegiatan }}</p>
            </div>
            <div>
                <p><strong>Nama</strong>: {{ $dataBooking->user->name }}</p>
                <p><strong>Prodi</strong>: {{ $dataBooking->user->unitkerja->nama }}</p>
                <p><strong>NPM</strong>: {{ $dataBooking->user->username }}</p>
                <p><strong>No HP</strong>:  {{ $dataBooking->user->no_telepon }}</p>
            </div>
        </div>

        <p></p>
        <p>Catatan :</p>
        <ol>
            <li>Formulir ini diserahkan pada saat Peminjaman dan Pengembalian</li>
            <li>Barang/alat dikembalikan dalam kondisi baik dan lengkap</li>
            <li>Apabila barang/alat hilang, pengguna ruangan wajib mengganti</li>
        </ol>

       
        <div class="qr-code">
            {!! QrCode::size(100)->generate(env('APP_URL'). 'master/booking/'.encrypt($dataBooking->id). '/edit'); !!}
        </div>

    </div>

    <script type="text/javascript">
        // Memicu dialog pencetakan saat halaman dimuat
        window.onload = function() {
            window.print();
        };
    </script>
    
</body>
</html>
