@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Halaman Update profile')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Profile</div>

                <div class="card-body">
                    @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ route('profil_update', encrypt($user->id)) }}">
                        @method('put')
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Nama</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-sm @error('name') is-invalid @enderror"
                                    name="name" placeholder="Nama"
                                    value="{{ old('name', $user->name) }}" readonly>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-2 control-label">Username</label>
                            <div class="col-md-6">
                                <input type="text"
                                    class="form-control form-control-sm @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username', $user->username) }}" readonly>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="email"
                                    class="form-control form-control-sm @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-2 control-label">No Telepon</label>
                            <div class="col-md-6">
                                <input type="number"
                                    class="form-control form-control-sm @error('no_telepon') is-invalid @enderror"
                                    name="no_telepon" placeholder="No Telepon"
                                    value="{{ old('no_telepon', $user->no_telepon) }}">
                                @error('no_telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-md-2 control-label">Foto</label>
                            <div class="col-md-6">
                                <label class="custom-file px-file" for="success-input-4">
                                    <input type="file" id="success-input-4" class="custom-file-input" name="foto" accept="image/*"
                                        onchange="previewImage()">
                                    <span class="custom-file-control form-control">Pilih file...</span>
                                    <div class="px-file-buttons">
                                        <button type="button" class="btn btn-xs px-file-clear">Clear</button>
                                        <button type="button" class="btn btn-primary btn-xs px-file-browse">Browse</button>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-2">
                                <div class="text-center">
                                    @if ($user->foto)
                                    <img src="{{ asset('storage/users/' . $user->foto) }}" class="img-preview img-fluid mb-3 d-block mx-auto"
                                        style="max-width: 250px;">
                                    @else
                                    <img class="img-preview img-fluid mb-3 mx-auto" style="max-width: 250px;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ route('home.index') }}" class="btn btn-xs btn-default"><i
                                        class="fa fa-arrow-left"></i> Kembali</a>
                                <button type="submit" class="btn btn-xs btn-warning">
                                    <i class="fa fa-edit"></i> Update Profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @push('js')
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
