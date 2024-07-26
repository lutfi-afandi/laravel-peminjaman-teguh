<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // unit kerja
        DB::table('unitkerjas')->insert([
            ['kode' => 'FEB', 'nama' => 'Fakultas Ekonomi dan Bisnis'],
            ['kode' => 'SPMI', 'nama' => 'Satuan Penjamin Mutu Internal'],
            ['kode' => 'KMS', 'nama' => 'Kemahasiswaan'],
            ['kode' => 'FTIK', 'nama' => 'Fakultas Teknik dan Ilmu Komputer'],
            ['kode' => 'FSIP', 'nama' => 'Fakultas Sastra dan Ilmu Pendidikan'],
            ['kode' => 'PusTIK', 'nama' => 'PusTIK'],
            ['kode' => 'IF', 'nama' => 'Informatika'],
            ['kode' => 'SI', 'nama' => 'Sistem Informasi'],
        ]);


        DB::table('users')->insert(
            [
                [
                    'username'  => 'admin',
                    'name'  => 'admin',
                    'email' => 'admin@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'admin',
                ],
                [
                    'username'  => 'mahasiswa',
                    'name'  => 'mahasiswa',
                    'email' => 'mahasiswa@gmail.com',
                    'password'  => bcrypt('rahasia'),
                    'level'  => 'mahasiswa',
                ],
            ]
        );

        $faker = Faker::create('id_ID');
        $usedUsernames = [];
        foreach (range(1, 10) as $index) {
            do {
                $username = $faker->numberBetween(17311001, 24129999);
            } while (in_array($username, $usedUsernames));

            $usedUsernames[] = $username;
            DB::table('users')->insert([
                'unitkerja_id' => $faker->numberBetween(1, 8),
                'name' => $faker->name,
                'username' =>  $username,
                'email' => $faker->unique()->safeEmail,
                'email_verified_at' => null,
                'password' => bcrypt('password'), // Default password, you can change it.
                // 'remember_token' => Str::random(10),
                'level' => $faker->randomElement(['admin', 'mahasiswa', 'baak']),
                'fakultas_kode' => null,
                'no_telepon' => $faker->phoneNumber,
                'email_pribadi' => $faker->optional()->safeEmail,
                // 'foto' => $faker->image('public/storage/images', 640, 480, null, false)
            ]);
        }

        // kategori
        $kategoris = [
            ['kode' => 'K1', 'nama' => 'Aset Tetap'],
            ['kode' => 'K2', 'nama' => 'Aset Bergerak'],
        ];
        DB::table('kategoris')->insert($kategoris);

        // Gedung
        $prefix = 'Gedung ';
        $letters = ['A', 'B', 'C', 'D', 'PU', 'ICT'];
        foreach ($letters as $index => $letter) {
            DB::table('gedungs')->insert([
                'kode' => 'G' . $letter, // Kode Gedung, misal GA, GB, GC, ...
                'nama' => $prefix . $letter,
                'lokasi' => 'Lokasi ' . $letter,
                'jumlah_lantai' => $faker->numberBetween(1, 4),
                'tahun' => $faker->year,
                'sumber_dana' => $faker->word,
                'besar_dana' => $faker->randomFloat(2, 100000, 1000000),
                'nilai_residu' => $faker->randomFloat(2, 50000, 500000),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Ruangan
        foreach (range(1, 20) as $index) {
            DB::table('ruangans')->insert([
                'kode_ruangan' => $faker->unique()->word,
                'nama_ruangan' => $faker->word,
                'gedung_id' => $faker->numberBetween(1, 5), // Assuming you have 20 gedungs
                'lantai' => $faker->word,
                'kapasitas' => $faker->numberBetween(10, 100),
                'luas' => $faker->randomFloat(2, 20, 200),
                'tipe' => $faker->word,
                'kondisi' => $faker->word,
                'status' => $faker->numberBetween(1, 3), // Assuming status ranges from 1 to 3
                'unitkerja_id' => $faker->numberBetween(1, 5), // Assuming you have 10 unitkerjas
                'bisa_pinjam' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Peminjaman
        DB::table('peminjaman_ruangans')->insert([
            [
                'user_id' => 2,
                'ruangan_id' => 1,
                'kegiatan'  => 'Rapat pimpinan',
                'no_peminjam'   => '085765842510',
                'waktu_pinjam'  => date('Y-m-d H:i:s'),
                'waktu_selesai' => date('Y-m-d H:i:s', strtotime('+2 hours')),
            ],

        ]);

        DB::table('peminjaman_barangs')->insert([
            [
                'user_id' => 2,
                'ruangan_id' => null,
                'kegiatan'  => 'Rapat pimpinan',
                'no_peminjam'   => '085765842510',
                'waktu_peminjaman'  => date('Y-m-d H:i:s'),
                'waktu_pengembalian' => date('Y-m-d H:i:s', strtotime('+2 hours')),
            ],

        ]);
    }
}
