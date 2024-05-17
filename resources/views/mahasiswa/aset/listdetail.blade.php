<div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr class="bg-success">
                <th>NO</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Lokasi Barang</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataBarang as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->barang->nama }}</td>
                    <td>{{ $item->jml_barang }}</td>
                    <td>{{ $item->barang->ruangan->nama_ruangan }}</td>
                    <td>
                        <a href="javascript:;" class="btn btn-xs btn-danger btn-outline btn-3d btn-hapus"
                            data-id="{{ $item->id }}">x</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    $('.btn-hapus').click(function(e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        var url = "{{ route('mahasiswa.peminjaman.hapusdetail', ':detail_id') }}";
        url = url.replace(":detail_id", id);
        $.ajax({
                method: "GET",
                url: url,
            })
            .done(function(data) {
                list_barang()
            })
    });
</script>
