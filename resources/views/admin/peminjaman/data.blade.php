@extends('layouts.tabler-admin.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="respon">
                @if (session()->has('msg'))
                    <div class="alert alert-important {{ session('class') }} alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div></div>
                            <div>{{ session('msg') }}</div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Peminjaman Barang</h3>
                    <div class="card-actions">
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-primary">
                        @include('admin.peminjaman.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="tempat-modal"></div>



    @push('js')
        <script>
            setTimeout(function() {
                document.getElementById('respon').innerHTML = '';
            }, 2000);
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // $(document).on("click", ".btn-delete", function() {
                //     var id = $(this).attr("data-id");
                //     // console.log(id);
                //     var url = "{{ route('admin.peminjaman.show', ':id_data') }}";
                //     url = url.replace(":id_data", id);
                //     $.ajax({
                //             method: "GET",
                //             url: url,
                //         })
                //         .done(function(data) {
                //             $('#tempat-modal').html(data.html);
                //             $('#modal_show').modal('show');
                //         })
                // })

                $(document).on("click", ".btn-detail", function() {
                    var id = $(this).attr("data-id");
                    // alert(id);
                    var url = "{{ route('admin.peminjaman.show', ':id_data') }}";
                    url = url.replace(":id_data", id);
                    $.ajax({
                            method: "GET",
                            url: url,
                        })
                        .done(function(data) {
                            $('#tempat-modal').html(data.html);
                            $('#modal_detail').modal('show');
                        })
                })

                $(document).on("click", ".btn-confirm", function() {
                    var id = $(this).attr("data-id");
                    // console.log(id);
                    var url = "{{ route('admin.peminjaman.edit', ':id_data') }}";
                    url = url.replace(":id_data", id);
                    $.ajax({
                            method: "GET",
                            url: url,
                        })
                        .done(function(data) {
                            $('#tempat-modal').html(data.html);
                            $('#modal_show').modal('show');
                        })
                })

                // $(document).on("click", ".btn-confirm", function() {
                //     var id = $(this).attr("data-id");
                //     var konfrimasi = $(this).attr("data-con");
                //     // alert(konfrimasi);
                //     var url = "{{ route('admin.peminjaman.update', ':id_data') }}";
                //     url = url.replace(":id_data", id);
                //     $.ajax({
                //             method: "PUT",
                //             url: url,
                //             data: {
                //                 _token: '{{ csrf_token() }}',
                //                 konfirmasi: konfrimasi,
                //             }
                //         })
                //         .done(function(data) {
                //             location.reload()
                //         })
                // })
            });
        </script>
    @endpush
@endsection
