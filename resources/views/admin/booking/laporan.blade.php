@extends('templateAdminLTE/home')
@section('sub-breadcrumb', 'Report Peminjaman')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Report Peminjaman Ruangan</h3>
                </div>
                <div class="panel-body">
                    <form id="reportForm" action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>

                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">- Pilih Status -</option>
                                <option value="1">Menunggu Konfirmasi</option>
                                <option value="2">Dikonfirmasi/Dipinjam</option>
                                <option value="3">Ditolak</option>
                                <option value="4">Dikembalikan</option>
                            </select>
                        </div>
                    </form>
                    <button type="button" class="btn btn-primary" id="lihatDataBtn">Lihat Data</button>
                </div>
            </div>

            <table class="table table-striped table-bordered " id="datatables">
                <thead style="text-align: center !important">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Peminjam</th>
                        <th>No Hp</th>
                        <th>Ruangan</th>
                        <th>Kegiatan</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
    
    
                    <tr class="odd gradeX ">

                    </tr>
    
                </tbody>
            </table>

            {{-- <button type="" class="btn btn-primary">Cetak Laporan</button> --}}
            <button type="button" class="btn btn-primary" id="cetakLaporanBtn" onclick="cetakLaporan()">Cetak Laporan</button>

        </div>


        
        
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#lihatDataBtn').click(function() {
            var formData = $('#reportForm').serialize();
            
            // Jika status tidak dipilih, hapus parameter status dari formData
            if (!$('#status').val()) {
                formData = formData.split('&').filter(function(item) {
                    return item.indexOf('status') === -1;
                }).join('&');
            }
            
            $.get('{{ route("fetch.data.laporan") }}', formData, function(response) {
                $('#datatables tbody').empty();
                if (response.length > 0) {
                    $.each(response, function(index, data) {
                        var statusText = '';
                        switch (data.status) {
                            case 1:
                                statusText = 'Menunggu Konfirmasi';
                                break;
                            case 2:
                                statusText = 'Dikonfirmasi/Dipinjam';
                                break;
                            case 3:
                                statusText = 'Ditolak';
                                break;
                            case 4:
                                statusText = 'Dikembalikan';
                                break;
                            default:
                                statusText = 'Unknown';
                                break;
                        }
                        var waktuPinjam = new Date(data.waktu_pinjam);
                        var waktuSelesai = new Date(data.waktu_selesai);
                        var formattedTime = waktuPinjam.toLocaleString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });
                        var formattedEndTime = waktuSelesai.toLocaleString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });
                        var waktuText = formattedTime + ' sampai ' + formattedEndTime;
                        $('#datatables tbody').append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${data.user.name}</td>
                                <td>${data.user.no_telepon}</td>
                                <td>${data.ruangan.nama_ruangan}</td>
                                <td>${data.kegiatan}</td>
                                <td>${waktuText}</td>
                                <td>${statusText}</td>
                            </tr>
                        `);
                    });
                } else {
                    $('#datatables tbody').append('<tr><td colspan="6" class="text-center">Tidak ada data yang ditemukan.</td></tr>');
                }
            });
        });
    });


    function cetakLaporan() {
    // Ambil nilai dari form
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    var status = $('#status').val();

    // Bangun URL cetak laporan
    var cetakUrl = '{{ route("admin.cetak.laporan") }}?start_date=' + startDate + '&end_date=' + endDate;
    
    // Jika status dipilih, tambahkan ke URL
    if (status) {
        cetakUrl += '&status=' + status;
    }

    // Buka URL dalam tab baru
    window.open(cetakUrl, '_blank');
}
</script>





@endpush
