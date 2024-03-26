<div class="modal fade in" id="modal_show" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Formulir Peminjaman</h4>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form-peminjaman">

                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="form-group">
                                <label for="kegiatan">Kegiatan</label>
                                <input type="text" name="kegiatan" id="kegiatan" class="form-control" required>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="form-group">
                                <label for="kegiatan">Ruangan</label>
                                <select name="ruangan_id" id="ruangan_id" class="form-control">
                                    <option value="" hidden>Pilih Ruangan</option>
                                    @foreach ($dataRuangan as $ruangan)
                                        <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }} | Gedung :
                                            {{ $ruangan->gedung->nama }}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <fieldset class="form-group">
                                <label for="tgl_peminjaman">Tanggal Mulai</label>
                                <input type="date" name="tgl_peminjaman" id="tgl_peminjaman" class="form-control"
                                    required>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label for="jam_peminjaman">Jam Mulai</label>
                                <input type="time" name="jam_peminjaman" id="jam_peminjaman" class="form-control"
                                    required>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <fieldset class="form-group">
                                <label for="tgl_pengembalian">Tanggal Selesai</label>
                                <input type="date" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control"
                                    required>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label for="jam_pengembalian">Jam Selesai</label>
                                <input type="time" name="jam_pengembalian" id="jam_pengembalian" class="form-control"
                                    required>
                            </fieldset>

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary btn-store"><i class="fa fa-save"></i> Simpan</button>
                </form>
            </div>

        </div>
    </div>
</div>



<script>
    $('.btn-store').click(function(e) {
        e.preventDefault();

        var tgl_peminjaman = $('#tgl_peminjaman').val();
        var jam_peminjaman = $('#jam_peminjaman').val();
        var tgl_pengembalian = $('#tgl_pengembalian').val();
        var jam_pengembalian = $('#jam_pengembalian').val();
        var ruangan_id = $('#ruangan_id').val();
        var kegiatan = $('#kegiatan').val();

        if (tgl_peminjaman && jam_peminjaman && tgl_pengembalian && jam_pengembalian && kegiatan) {
            $.ajax({
                url: "{{ route('mahasiswa.peminjaman.store') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    ruangan_id: ruangan_id,
                    tgl_peminjaman: tgl_peminjaman,
                    jam_peminjaman: jam_peminjaman,
                    tgl_pengembalian: tgl_pengembalian,
                    jam_pengembalian: jam_pengembalian,
                    kegiatan: kegiatan
                },
                success: function(response) {
                    // Reset formulir menggunakan form.initialize
                    $('#form-peminjaman')[0].reset();
                    $('#modal_show').modal('hide');
                    list_peminjaman();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        } else {
            alert('Harap isi semua input!');
        }
    });
</script>
