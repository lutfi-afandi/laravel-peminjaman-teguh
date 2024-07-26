<div class="modal modal-blur fade" id="modal_show" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-blue text-blue-fg">
                <h4 class="modal-title">Formulir Peminjaman</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form-peminjaman">
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ auth()->user()->name }}" disabled>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label for="username">NPM</label>
                                <input type="text" name="username" id="username" class="form-control"
                                    value="{{ auth()->user()->username }}" disabled>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label for="no_peminjam">No WA</label>
                                <input type="text" name="no_peminjam" id="no_peminjam" class="form-control"
                                    autofocus>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <fieldset class="form-group">
                                <label for="kegiatan">Kegiatan</label>
                                <input type="text" name="kegiatan" id="kegiatan" class="form-control" required>
                            </fieldset>
                        </div>
                    </div>
                    {{-- <div class="row">
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
                    </div> --}}
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label for="waktu_peminjaman">Waktu Peminjaman</label>
                                <input type="datetime-local" name="waktu_peminjaman" id="waktu_peminjaman"
                                    class="form-control" required>
                                <div class="alert alert-important alert-warning alert-dismissible d-none mt-1"
                                    role="alert" id="deadline">
                                    <div class="d-flex">
                                        <div>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z">
                                                </path>
                                                <path d="M12 9v4"></path>
                                                <path d="M12 17h.01"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <strong>Peringatan!</strong> Anda meminjam dalam H-3. Peminjaman barang bisa
                                            dilanjutkan, dengan menyertakan surat pernyataan ke Pustik
                                        </div>
                                    </div>
                                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                </div>

                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group f-waktu_pengembalian d-none">
                                <label for="waktu_pengembalian">Sampai Dengan</label>
                                <input type="datetime-local" name="waktu_pengembalian" id="waktu_pengembalian"
                                    class="form-control" required>
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

        var waktu_peminjaman = $('#waktu_peminjaman').val();
        var waktu_pengembalian = $('#waktu_pengembalian').val();
        // var jam_peminjaman = $('#jam_peminjaman').val();
        // var jam_pengembalian = $('#jam_pengembalian').val();
        // var ruangan_id = $('#ruangan_id').val();
        var kegiatan = $('#kegiatan').val();
        var no_peminjam = $('#no_peminjam').val();

        // if (tgl_peminjaman && jam_peminjaman && tgl_pengembalian && jam_pengembalian && kegiatan) {
        if (waktu_peminjaman && waktu_pengembalian && kegiatan) {
            $.ajax({
                url: "{{ route('mahasiswa.peminjaman.store') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // ruangan_id: ruangan_id,
                    waktu_peminjaman: waktu_peminjaman,
                    waktu_pengembalian: waktu_pengembalian,
                    no_peminjam: no_peminjam,
                    // jam_peminjaman: jam_peminjaman,
                    // jam_pengembalian: jam_pengembalian,
                    kegiatan: kegiatan
                },
                success: function(response) {
                    // Reset formulir menggunakan form.initialize
                    // $('#form-peminjaman')[0].reset();
                    // $('#modal_show').modal('hide');
                    // list_peminjaman();

                    if (response.status === 'success') {
                        // Redirect ke URL yang diberikan dalam respons JSON
                        window.location.href = response.redirect_url;
                    } else {
                        // Tampilkan pesan error jika ada
                        alert(response.message);
                    }

                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        } else {
            alert('Harap isi semua input!');
        }
    });

    $('#waktu_peminjaman').change(function() {
        // Mendapatkan nilai dari input datetime-local
        var inputDate = new Date($(this).val());
        var sekarang = new Date();

        // Reset time of 'sekarang' to start of the day (00:00:00)
        sekarang.setHours(0, 0, 0, 0);
        var batasWaktu = new Date(sekarang);
        batasWaktu.setDate(batasWaktu.getDate() + 3);

        if (inputDate < batasWaktu) {
            alert("Belum H-3");
            $('.f-waktu_pengembalian').removeClass('d-none');
            $('#deadline').removeClass('d-none');
            // }
        } else {
            $('#deadline').addClass('d-none');
            $('.f-waktu_pengembalian').removeClass('d-none');

        }
    });

    $('#waktu_pengembalian').change(function() {
        var waktuPeminjaman = new Date($('#waktu_peminjaman').val());
        var waktuPengembalian = new Date($(this).val());

        if (waktuPengembalian <= waktuPeminjaman) {
            // Tampilkan pesan kesalahan atau lakukan sesuatu sesuai kebutuhan Anda
            alert("Waktu pengembalian harus setelah waktu peminjaman");
            // Menghapus nilai yang dipilih pada input waktu pengembalian
            $(this).val('');
        } else {
            // Jika waktu pengembalian valid, tampilkan bidang yang diinginkan
            $('.f-ruangan_id').show();
        }
    });
</script>
