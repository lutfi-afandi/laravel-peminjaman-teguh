
<table class="table table-striped table-bordered" id="datatables">
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="10%">Aksi</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Level</th>
            <th>Unit Kerja</th>
            <th>No Telepon</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataUser as $user)
            <tr class="odd gradeX">
                <td class="center">{{ $loop->iteration }}</td>
                <td class="center">
                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary btn-xs btn-update">
                        <i class="fa fa-edit"></i>
                    </a>

                    @if($user->id !== auth()->id())
                    <a href="javascript:;" data-id="{{ $user->id }}" class="btn btn-danger btn-xs btn-delete">
                        <i class="fa fa-trash"></i>
                    </a>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->level }}</td>
                <td>{{ $user->unitkerja->kode ?? '-' }}</td>
                <td>{{ $user->no_telepon}}</td>
                
                <td>
                    <img src="{{ asset('storage/users/' . $user->foto) }}" alt="Foto {{ $user->name }}" style="width: 100px;
                    height: 200;">
                </td>
                
            </tr>
        @endforeach
    </tbody>
</table>


