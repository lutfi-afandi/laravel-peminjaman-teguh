<table class="table table-striped table-bordered" id="datatables">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="10%">Aksi</th>
            <th>Kode Unit Kerja</th>
            <th>Nama Unit Kerja</th>
           
        </tr>
    </thead>
    <tbody>
        @foreach ($unitKerja as $key)
            <tr class="odd gradeX">
                <td class="center">{{ $loop->iteration }}</td>
                <td class="center">
                    <a href="{{ route('admin.unit.edit', $key->id) }}" class="btn btn-primary btn-xs btn-update">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a href="javascript:;" data-id="{{ $key->id }}" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
                <td>{{ $key->kode }}</td>
                <td>{{ $key->nama }}</td>
                
                
            </tr>
        @endforeach
    </tbody>
</table>
