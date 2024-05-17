<table class="table table-striped table-bordered " id="datatables">
    <thead style="text-align: center !important">
        <tr>
            <th width="5%">No</th>
            <th width="10%">Aksi</th>
            <th>Ruangan</th>
            <th>Gedung</th>
            <th>Lantai</th>
            <th>Kapasitas (Orang)</th>
            <th>Tipe Ruangan</th>
            <th>Kondisi Ruangan</th>
            <th>Unit Kerja</th>
        </tr>
    </thead>
    <tbody> @php
        // dd($dataRuangan);
    @endphp
        @foreach ($dataRuangan as $ruang)
            <tr class="odd gradeX text-center">
                <td class="center">{{ $loop->iteration }}</td>
                <td class="center">
                    
                    <a href="{{ route('admin.ruangan.edit', $ruang->id) }}" class="btn btn-primary btn-xs btn-update">
                        <i class="fa fa-edit"></i>
                    </a>

                    <a href="javascript:;" data-id="{{ $ruang->id }}" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash"></i>
                    </a>
                    
                    
                </td>

                <td><b>{{ $ruang->kode_ruangan }}</b> <br> {{ $ruang->nama_ruangan }} </td>
                <td><b>{{ $ruang->gedung->kode }}</b> <br> {{ $ruang->gedung->nama }} </td>
                <td>Lantai {{ $ruang->lantai }}</td>
                <td> {{ $ruang->kapasitas }}</td>
                <td> {{ $ruang->tipe }}</td>
                <td> {{ $ruang->kondisi }}</td>
                @php
                    // dd($ruang->unitkerja->nama);
                @endphp
                <td> {{ $ruang->unitkerja->kode }} - {{ $ruang->unitkerja->nama }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
