@extends('layouts.tabler-front.master')
@section('content')
    <div class="row">
        <div class="col-md-12 ">
            <h1 class="text-center m-b-0">Daftar Peminjaman</h1>
            {{-- <p class="text-center">Pilih Tanggal Peminjaman</p> --}}

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Peminjaman Barang : <strong>{{ auth()->user()->name }}</strong>
                    </h3>
                    <div class="card-actions">

                        <a href="#" class="btn btn-primary btn-add-peminjaman" data-bs-toggle="modal"
                            data-bs-target="#modal-large">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-apps" width="44"
                                height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path d="M4 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path d="M14 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                <path d="M14 7l6 0" />
                                <path d="M17 4l0 6" />
                            </svg>
                            buat peminjaman baru </a>
                        <a href="/ruangan" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-guide"
                                width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M7 19h3a2 2 0 0 0 2 -2v-8a2 2 0 0 1 2 -2h7" />
                                <path d="M18 4l3 3l-3 3" />
                            </svg>
                            Peminjaman Ruangan </a>
                    </div>
                </div>
                <div class="card-body">
                    <div id="respon">
                        @if (session()->has('msg'))
                            <div class="alert alert-important alert {{ session('class') }} alert-dismissible"
                                role="alert">
                                <div class="d-flex">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-info-hexagon" width="44" height="44"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                                            <path d="M12 9h.01" />
                                            <path d="M11 12h1v4h1" />
                                        </svg>
                                    </div>
                                    <div>
                                        {{ session('msg') }}
                                    </div>
                                </div>
                                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                            </div>
                        @endif
                    </div>
                    <div class="list-peminjaman"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="tempat-modal"></div>
@endsection
@push('js')
    <script>
        function list_peminjaman() {
            var url = "{{ route('mahasiswa.peminjaman.index') }}";
            $.ajax({
                    method: "GET",
                    url: url,
                })
                .done(function(data) {
                    $('.list-peminjaman').html(data.html);
                })
        }



        setTimeout(function() {
            document.getElementById('respon').innerHTML = '';
        }, 2000);

        $(document).ready(function() {
            list_peminjaman();
        });

        $('.btn-add-peminjaman').click(function(e) {
            e.preventDefault();
            // alert(this)
            var url = "{{ route('mahasiswa.peminjaman.create') }}";
            $.ajax({
                    method: "GET",
                    url: url,
                })
                .done(function(data) {
                    $('#tempat-modal').html(data.html);
                    $('#modal_show').modal('show');
                })
                .fail(function(xhr) {
                    console.log("Failed to fetch create form:", xhr); // Debug line
                });
        });
    </script>
@endpush
