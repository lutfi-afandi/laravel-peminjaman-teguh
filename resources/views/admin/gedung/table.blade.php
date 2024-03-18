<table class="table table-striped table-bordered" id="datatables">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="10%">Aksi</th>
            <th>Kode Gedung</th>
            <th>Nama Gedung</th>
            <th>Sumber Dana</th>
            <th>Lokasi</th>
            <th>Nilai Perolehan (Rp.)</th>
            <th>Tahun Perolehan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataGedung as $key)
            <tr class="odd gradeX">
                <td class="center">{{ $loop->iteration }}</td>
                <td class="center">
                    <a href="{{ route('admin.gedung.edit', $key->id) }}" class="btn btn-primary btn-xs btn-update">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a href="javascript:;" data-id="{{ $key->id }}" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
                <td>{{ $key->kode }}</td>
                <td>{{ $key->nama }}</td>
                <td>{{ $key->sumber_dana }}</td>
                <td>{{ $key->lokasi }}</td>
                <td>Rp.{{ number_format($key->besar_dana, 0, ',', '.') }}</td>
                <td>{{ $key->tahun }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
