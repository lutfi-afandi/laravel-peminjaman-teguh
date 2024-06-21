
<table class="table table-striped table-bordered " id="datatables">
    <thead style="text-align: center !important">
        <tr>
            <th width="5%">No</th>
            <th width="10%">Aksi</th>
            <th>Nama Peminjam</th>
            <th>Kegiatan</th>
            <th>Waktu</th>
            <th>Ruangan</th>
            <th>Status</th>

        </tr>
    </thead>
    <tbody>
        
        @foreach ($dataBooking as $booking)
            <tr class="odd gradeX ">
                <td class="center">{{ $loop->iteration }}</td>
                <td>
                    <a href="javascript:;" data-id="{{ $booking->id }}" class="btn btn-info btn-sm btn-confirm">
                        Konfirmasi</i>
                    </a>

                    <a style="margin-top: 5px;" href="https://api.whatsapp.com/send?phone={{ $booking->user->no_telepon }}&text=Pesan" target="_blank" class="btn btn-sm btn-success">
                        <i class="fa fa-envelope"></i> WhatsApp
                     </a>

                    <a style="margin-top: 5px;" href="{{ route('admin.booking.edit', encrypt($booking->id)) }}" class="btn btn-sm btn-warning">
                        <i class="fa fa-edit"></i> Edit
                     </a>
                </td>
                <td class="center">{{ $booking->user->name }}</td>
                <td>{{ $booking->kegiatan }}</td>
                
                <td>
                    <span
                    class="text-primary">{{ \Carbon\Carbon::parse($booking->waktu_pinjam)->isoFormat('dddd, D MMMM YYYY') }}
                    </span> <br>
                    
                    <span
                        class="text-success">{{ date('H:i', strtotime($booking->waktu_pinjam)) . ' s/d ' . date('H:i', strtotime($booking->waktu_selesai)) }} WIB</span> <br>
                    
                </td>
                
                <td>
                    

                        {{ $booking->ruangan->nama_ruangan }}

                   
                </td>
                <td>
                    @switch($booking->status)
                    @case(1)
                        <small class="text-xs badge bg-secondary"><i class="fa fa-spinner fa-spin"></i> menunggu
                            konfirmasi</small>
                    @break

                    @case(2)
                        <small class="text-xs badge bg-warning"><i class="fa fa-info"></i> Dibooking/Dipinjam
                            </small>
                    @break

                    @case(3)
                        <small class="text-xs badge bg-danger"><i class="fa fa-xmark "></i> Booking
                            ditolak</small>
                    @break

                    @case(4)
                        <small class="text-xs badge bg-success"><i class="fa fa-check-double "></i> dikembalikan</small>
                    @break

                    @default
                @endswitch
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
