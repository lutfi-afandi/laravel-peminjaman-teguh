<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanBarangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_barangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('yang pinjam')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->string('no_peminjam');
            $table->string('kegiatan', 255)->nullable();
            $table->dateTime('waktu_peminjaman');
            $table->dateTime('waktu_pengembalian');
            $table->string('nama_petugas', 255)->nullable()->comment('yang konfirmasi');
            $table->integer('konfirmasi')->default(1)->comment('1: menunggu, 2. dikonfirmasi/sedang dipinjam, 3. Ditolah, 4. Dikembalikan');
            $table->string('keterangan', 255)->nullable();
            $table->date('tgl_pemesanan')->nullable();
            $table->date('tgl_peminjaman')->nullable();
            $table->time('jam_peminjaman')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->time('jam_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman_barangs');
    }
}
