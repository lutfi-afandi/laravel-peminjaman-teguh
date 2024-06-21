@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Edit Peminjaman Aset')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="respon"></div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-12 card-tools text-right">
                            <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-xs btn-warning btn-add">
                                <i class="fa fa-arrow-left"></i> kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{ route('admin.peminjaman.update', $dataPinjam->id) }}" method="POST"
                          class="form-horizontal" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6 @error('name') has-error @enderror">
                                <label for="name" class="control-label">Nama Peminjam</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="name Barang" value="{{ old('name', $dataPinjam->user->name) }}" readonly>
                                @error('name')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 @error('npm') has-error @enderror">
                                <label for="npm" class="control-label">NPM/Username</label>
                                <input type="text" class="form-control" id="npm" npm="npm"
                                       placeholder="npm Barang" value="{{ old('npm', $dataPinjam->user->username) }}" readonly>
                                @error('npm')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 @error('no_telepon') has-error @enderror">
                                <label for="no_telepon" class="control-label">No Telepon</label>
                                <input type="text" class="form-control" id="no_telepon" no_telepon="no_telepon"
                                       placeholder="no_telepon Barang" value="{{ old('no_telepon', $dataPinjam->user->no_telepon) }}" readonly>
                                @error('no_telepon')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 @error('nama_ruangan') has-error @enderror">
                                <label for="nama_ruangan" class="control-label">Nama Ruangan</label>
                                <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan"
                                       value="{{ old('nama_ruangan', $dataPinjam->ruangan->nama_ruangan) }}" readonly>
                                @error('nama_ruangan')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 @error('kegiatan') has-error @enderror">
                                <label for="kegiatan" class="control-label">Kegiatan</label>
                                <input type="text" class="form-control" id="kegiatan" name="kegiatan"
                                       value="{{ old('kegiatan', $dataPinjam->kegiatan) }}" readonly>
                                @error('kegiatan')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 @error('barang') has-error @enderror">
                                <label for="barang" class="control-label">Barang</label>
                                <button type="button" class="form-control btn btn-sm btn-warning" onclick="toggleDetailPinjam()">
                                    <i class="fa fa-eye"></i>Lihat Barang
                                </button>
                                @error('barang')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                                <div id="detailPinjam" style="display: none; margin-top: 10px;">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Kode Barang</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($detailPinjam as $detail)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $detail->barang->nama }}</td>
                                                    <td>{{ $detail->barang->kode }}</td>
                                                    <td>{{ $detail->jml_barang }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 @error('waktu_peminjaman') has-error @enderror">
                                <label for="waktu_peminjaman" class="control-label">Waktu Pinjam</label>
                                <input type="text" class="form-control" id="waktu_peminjaman" name="waktu_peminjaman"
                                       readonly value="{{ old('waktu_peminjaman', date('d/m/Y', strtotime($dataPinjam->waktu_peminjaman))) }}">
                                @error('waktu_peminjaman')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 @error('waktu_pengembalian') has-error @enderror">
                                <label for="waktu_pengembalian" class="control-label">Waktu Selesai</label>
                                <input type="text" class="form-control" id="waktu_pengembalian" name="waktu_pengembalian"
                                       readonly value="{{ old('waktu_pengembalian', date('d/m/Y', strtotime($dataPinjam->waktu_pengembalian))) }}">
                                @error('waktu_pengembalian')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 @error('konfirmasi') has-error @enderror">
                                <label for="konfirmasi" class="control-label">Konfirmasi</label>
                                <select name="konfirmasi" id="konfirmasi" class="form-control">
                                    <option value="">-Pilih konfirmasi-</option>
                                    <option value="1" {{ $dataPinjam->konfirmasi == 1 ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                    <option value="2" {{ $dataPinjam->konfirmasi == 2 ? 'selected' : '' }}>Dibooking/Sedang Dipinjam</option>
                                    <option value="3" {{ $dataPinjam->konfirmasi == 3 ? 'selected' : '' }}>Ditolak</option>
                                    <option value="4" {{ $dataPinjam->konfirmasi == 4 ? 'selected' : '' }}>Dikembalikan</option>
                                </select>
                                @error('konfirmasi')
                                    <small class="form-message">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row" style="margin-top: 8px">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="tempat-modal"></div>
    @push('js')
        <script>
            function toggleDetailPinjam() {
                var detailPinjamDiv = document.getElementById('detailPinjam');
                if (detailPinjamDiv.style.display === 'none' || detailPinjamDiv.style.display === '') {
                    detailPinjamDiv.style.display = 'block';
                } else {
                    detailPinjamDiv.style.display = 'none';
                }
            }
        </script>
        <script>
            setTimeout(function() {
                document.getElementById('respon').innerHTML = '';
            }, 3000);
        </script>
        <script>
            function previewImage() {
                const image = document.querySelector('#success-input-4');
                const imgPreview = document.querySelector('.img-preview');
                imgPreview.style.display = 'block';
                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        </script>
        <script>
            $(function() {
                $("#tgl_perolehan").datepicker();
            });
        </script>
    @endpush
@endsection
