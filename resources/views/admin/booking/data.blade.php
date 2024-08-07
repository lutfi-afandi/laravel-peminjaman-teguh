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
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Booking Ruangan</div>
                <div class="card-actions">
                    <a href="{{ route('admin.scan.qrcode') }}" class="btn btn-sm btn-primary"> <i class="fa fa-qrcode"></i>
                        &nbsp; Scan QrCode</a>

                </div>
            </div>
            <div class="card-body">
                <div class="table-primary">
                    @include('admin.booking.table')
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on("click", ".btn-confirm", function() {
                var id = $(this).attr("data-id");
                // console.log(id);
                var url = "{{ route('admin.booking.show', ':id_data') }}";
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
        });
    </script>
@endpush
