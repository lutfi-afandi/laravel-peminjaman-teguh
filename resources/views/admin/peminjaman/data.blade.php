@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Data Peminjaman')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="respon">
                @if (session()->has('msg'))
                    <div class="alert {{ session('class') }} alert-dark">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('msg') }}
                    </div>
                @endif
            </div>
            <div class="panel">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6 panel-title">Data Peminjaman</div>
                        <div class="col-sm-6 card-tools text-right">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
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
