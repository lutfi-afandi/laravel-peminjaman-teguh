@extends('templateAdminLTE/home')
@section('sub-breadcrumb', $title)
@section('content')
    <div class="row bg-white">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="text-center m-b-0">Daftar Peminjaman</h1>
            <p class="text-center">Pilih Tanggal Peminjaman</p>

        </div>
    </div>
    <div class="row bg-white">
        <div class="col-md-8 col-md-offset-2">
            <div id="respon">
                @if (session()->has('msg'))
                    <div class="alert {{ session('class') }} alert-dark">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('msg') }}
                    </div>
                @endif
            </div>
            <div class="panel panel-black">
                <div class="panel-heading">
                    <span class="panel-title">Riwayat Peminjaman : <strong>{{ auth()->user()->name }}</strong></span>
                    <div class="panel-heading-controls">
                        <ul class="pager pager-xs">
                            <li><a href="javascript:;" class=" bg-primary btn-add-peminjaman">buat peminjaman baru +</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-light">
                    <div class="list-peminjaman"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="tempat-modal"></div>


@endsection
@push('js')
    <script>
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
        });

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
    </script>
@endpush
