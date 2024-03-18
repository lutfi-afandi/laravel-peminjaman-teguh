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
                    'kode'  => 'B001',
                    'nama'  => 'Barang 1',
                    'jumlah'  => 1,
                    'harga'  => 1000,
                    'deskripsi' => 'test',
                    'kategori_id'  => 1,
                    'ruangan_id'  => 1,
                ],
            ]
        );
    }
}
