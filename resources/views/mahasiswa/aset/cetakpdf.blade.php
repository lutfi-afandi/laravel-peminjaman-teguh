<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1024, initial-scale=1.0">
    <title>Cetak Peminjaman Aset</title>

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
        position: absolute; /* Tambahkan ini untuk membuat posisi absolut */
        bottom: 10px; /* Tambahkan ini untuk menjaga jarak dari bawah */
        right: 10px; /* Tambahkan ini untuk menjaga jarak dari kanan */
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
            align-items: flex-start; /* Agar teks di aling di atas */
        }

        .data > div {
            width: 48%; /* Atur lebar agar cocok dengan ruang yang tersedia */
        }

        .data p {
            margin: 0;
            display: flex;
            align-items: center;
        }

        .data p strong {
            width: 120px; /* Lebar untuk teks */
            display: inline-block; /* Agar width bekerja */
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
        <h1>Peminjaman Asset</h1>
        
        <!-- Data -->
        <div class="data">
           
            <div>
                <p><strong>Hari</strong>: {{ \Carbon\Carbon::parse($dataPeminjaman->waktu_peminjaman)->isoFormat('dddd, D MMMM YYYY') }}</p>
                <p><strong>Waktu</strong>:  <span
                    class="text-primary">{{ date('H:i', strtotime($dataPeminjaman->waktu_peminjaman)) . ' s/d ' . date('H:i', strtotime($dataPeminjaman->waktu_pengembalian)) }} WIB</span> <br></p>
                <p><strong>Ruangan</strong>: {{ $dataPeminjaman->ruangan->nama_ruangan }}</p>
                <p><strong>Kegiatan</strong>: {{ $dataPeminjaman->kegiatan }}</p>
            </div>
            <div>
                <p><strong>Nama</strong>: {{ $dataPeminjaman->user->name }}</p>
                <p><strong>Prodi</strong>: {{ $dataPeminjaman->user->unitkerja->nama }}</p>
                <p><strong>NPM</strong>: {{ $dataPeminjaman->user->username }}</p>
                <p><strong>No HP</strong>:  {{ $dataPeminjaman->user->no_telepon }}</p>
            </div>
            
        </div>

        <p></p>
        <!-- Tabel -->
        <table>
            <thead>
                
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                  
                
            </thead>
            <tbody>
                @foreach ($dataPeminjaman->detail_peminjaman as $dataBarang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dataBarang->barang->nama }}</td>
                    <td>{{ $dataBarang->jml_barang }}</td>
                   
                </tr>
               @endforeach
                
            </tbody>
        </table>
        
        <p>Catatan :</p>
        <ol>
            <li>Formulir ini diserahkan pada saat Peminjaman dan Pengembalian</li>
            <li>Barang/alat dikembalikan dalam kondisi baik dan lengkap</li>
            <li>Apabila barang/alat hilang, pengguna ruangan wajib mengganti</li>
        </ol>

        <div class="visible-print text-center qr-code">
            {!! QrCode::size(100)->generate(env('APP_URL'). 'master/peminjaman/ubah/'.encrypt($dataPeminjaman->id)); !!}
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
