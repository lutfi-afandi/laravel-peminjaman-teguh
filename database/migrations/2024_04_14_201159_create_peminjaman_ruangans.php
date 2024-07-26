<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanRuangans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_ruangans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->comment('Peminjam')->constrained()->onDelete('cascade');
            $table->foreignId('ruangan_id')->comment('Ruangan yang dipinjam')->constrained()->onDelete('cascade');
            $table->string('no_peminjam');
            $table->string('kegiatan', 255);
            $table->dateTime('waktu_pinjam');
            $table->dateTime('waktu_selesai')->nullable();
            $table->time('jam_pinjam')->nullable();
            $table->time('jam_selesai')->nullable();
            $table->integer('status')->default(1)->comment('1: menunggu, 2. dikonfirmasi/sedang dipinjam, 3. Ditolak, 4. Dikembalikan');
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
        Schema::dropIfExists('peminjaman_ruangans');
    }
}
