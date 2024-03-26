<div class="modal fade modal-alert modal-info in" id="modal_detail" role="dialog" style="padding:0;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Detail Peminjaman Barang</div>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered " id="datatables">
                    <thead style="text-align: center !important">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailPeminjaman as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->barang->nama }}</td>
                                <td>{{ $detail->jml_barang }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
