<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {

            $table->id();
            $table->string('kode', 50)->unique();
            $table->string('nama', 255);
            $table->decimal('harga', 10, 2);
            $table->double('jumlah')->nullable();
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('penanggung_jawab', 50)->nullable();
            $table->date('tgl_perolehan')->nullable();
            $table->year('tahun_perolehan')->nullable();
            $table->decimal('harga_perolehan', 10, 2)->nullable();
            $table->string('kondisi', 20)->nullable();
            $table->text('deskripsi')->nullable();
            $table->integer('status')->default(1);
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('barangs');
    }
}
