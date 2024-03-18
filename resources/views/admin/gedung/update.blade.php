@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Data Gedung')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="respon">

            </div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-12 card-tools text-right">
                            <a href="{{ route('admin.gedung.index') }}" class="btn btn-xs btn-warning btn-add">
                                <i class="fa fa-arrow-left"></i> kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    <form action="{{ route('admin.gedung.update', $dataGedung->id) }}" method="POST"
                        class="form-horizontal" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        {{-- <div class="form-group"> --}}
                        <div class="row">
                            <div class="col-md-6 @error('kode') has-error @enderror">
                                <label for="kode" class="control-label">Kode Gedung</label>
                                <input type="text" class="form-control" id="kode" name="kode"
                                    placeholder="Kode Gedung" value="{{ old('kode', $dataGedung->kode) }}" readonly>
                                @error('kode')
                                    <small class="form-message">
                                        {{ $message }}
                                    </small>
                                @enderror
                                {{-- <small class="text-muted form-help-text">Example block-level help text here.</small> --}}
                            </div>
                            <div class="col-md-6  @error('nama') has-error @enderror">
                                <label for="nama" class=" control-label">Nama Gedung</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Nama Gedung" value="{{ old('nama', $dataGedung->nama) }}" required>
                                @error('nama')
                                    <small class="form-message">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  @error('jumlah_lantai') has-error @enderror">
                                <label for="jumlah_lantai" class="control-label">Jumlah Lantai</label>
                                <input type="number" class="form-control" id="jumlah_lantai" name="jumlah_lantai"
                                    placeholder="Jumlah lantai" required
                                    value="{{ old('jumlah_lantai', $dataGedung->jumlah_lantai) }}">
                                @error('jumlah_lantai')
                                    <small class="form-message">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6  @error('lokasi') has-error @enderror">
                                <label for="lokasi" class="control-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi"
                                    placeholder="Lokasi" value="{{ old('lokasi', $dataGedung->lokasi) }}">
                                @error('lokasi')
                                    <small class="form-message">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6  @error('besar_dana') has-error @enderror">
                                <label for="besar_dana" class=" control-label">Besar Dana</label>
                                <input type="text" class="form-control" id="besar_dana" name="besar_dana"
                                    placeholder="Jumlah dana perolehan"
                                    value="{{ old('besar_dana', $dataGedung->besar_dana) }}">
                            </div>
                            <div class="col-md-6  @error('sumber_dana') has-error @enderror">
                                <label for="sumber_dana" class=" control-label">Sumber Dana</label>
                                <input type="text" class="form-control" id="sumber_dana" name="sumber_dana"
                                    placeholder="Sumber dana" value="{{ old('sumber_dana', $dataGedung->sumber_dana) }}">
                                @error('sumber_dana')
                                    <small class="form-message">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6  @error('tahun') has-error @enderror">
                                <label for="tahun" class=" control-label">Tahun Perolehan</label>
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="">-Pilih Tahun-</option>
                                    @for ($year = date('Y'); $year >= 2000; $year--)
                                        <option value="{{ $year }}"
                                            {{ $year == $dataGedung->tahun ? 'selected' : '' }}>{{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('tahun')
                                    <small class="form-message">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="foto" class="control-label">Foto Gedung</label>
                                <label class="custom-file px-file" for="success-input-4">
                                    <input type="file" id="success-input-4" class="custom-file-input" name="foto"
                                        accept="image/*" onchange="previewImage()">
                                    <span class="custom-file-control form-control">Pilih file...</span>
                                    <div class="px-file-buttons">
                                        <button type="button" class="btn btn-xs px-file-clear">Clear</button>
                                        <button type="button"
                                            class="btn btn-primary btn-xs px-file-browse">Browse</button>
                                    </div>
                                </label>
                                @if ($dataGedung->foto)
                                    <img src="{{ asset('storage/gedungs/' . $dataGedung->foto) }}"
                                        class="img-preview img-fluid mb-3 d-block" width="250px">
                                @else
                                    <img class="img-preview img-fluid mb-3" width="250px">
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
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
    @endpush
@endsection
