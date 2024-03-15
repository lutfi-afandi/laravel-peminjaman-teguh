<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barangs')->insert(
            [
                [
                    'nama_barang'  => 'Barang 1',
                    'qty'  => 1,
                    'harga_barang'  => 1000,
                    'deskripsi' => 'test',
                    'kategori_id'  => 1,
                ],
            ]
        );
    }
}
