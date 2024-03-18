<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_ruangan', 50)->unique(); // Unique identifier for the room
            $table->string('nama_ruangan', 255); // Name of the room

            $table->unsignedBigInteger('gedung_id'); // Foreign key referencing the 'id' column in the 'gedungs' table

            $table->string('lantai', 50); // Floor level of the room
            $table->integer('kapasitas'); // Maximum occupancy of the room
            $table->decimal('luas', 10, 2)->nullable(); // Area of the room in square meters

            $table->string('tipe', 50); // Type of room (e.g., office, conference room, laboratory)
            $table->string('kondisi', 50); // Condition of the room (e.g., good, fair, poor)

            $table->integer('status')->default(1); // Status of the room (active or inactive)
            $table->unsignedBigInteger('unit_kerja_id'); // Foreign key referencing the 'id' column in the 'unit_kerjas' table (nullable)

            $table->string('foto_ruangan')->nullable(); // Path or URL to the room's photo (nullable)
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
        Schema::dropIfExists('ruangans');
    }
}
