<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Paket;
use App\Models\PaketDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'nim' => '123123',
            'password' => 'admin',
            'username' => 'admin',
        ]);


        \App\Models\Prodi::factory()->create([
            'name' => 'Fiqih',
        ]);


        \App\Models\Prodi::factory()->create([
            'name' => 'Ski',
        ]);

        \App\Models\Prodi::factory()->create([
            'name' => 'Akidah',
        ]);

        // \App\Models\Mahasiswa::factory()->create([
        //     'nim' => '123123',
        //     'name' => 'admin',
        //     'kelas' => '4B',
        //     'user_id' => 1,
        //     'prodi_id' => 1,
        // ]);

        // \App\Models\User::factory()->create([
        //     'nim' => '2020573010006',
        //     'password' => '2020573010006',
        //     'username' => 'alvinsyahri',
        //     'is_admin' => 0,
        // ]);

        // \App\Models\Mahasiswa::factory()->create([
        //     'nim' => '2020573010006',
        //     'name' => 'Alvin Syahri',
        //     'kelas' => '4B',
        //     'user_id' => 2,
        //     'prodi_id' => 1,
        // ]);

        // \App\Models\User::factory()->create([
        //     'nim' => '12341234',
        //     'password' => '12341234',
        //     'username' => 'salahuddin',
        //     'is_admin' => 2,
        // ]);

        // \App\Models\Dosen::factory()->create([
        //     'nim' => '12341234',
        //     'name' => 'Salahuddin',
        //     'kelas' => '4B',
        //     'user_id' => 3,
        //     'prodi_id' => 1,
        // ]);

        // $paketData = [
        //     [
        //         'name' => 'Paket 1',
        //         'start' => now(),
        //         'end' => now()->addDays(7),
        //     ],
        //     [
        //         'name' => 'Paket 2',
        //         'start' => now(),
        //         'end' => now()->addDays(7),
        //     ],
        //     // Tambahkan paket lainnya jika diperlukan
        // ];

        // foreach ($paketData as $index => $paket) {
        //     $createdPaketId = DB::table('pakets')->insertGetId($paket);

        //     $paketDetails = [
        //         ['name' => "fiqih ". ($index + 1), 'prodi_id' => 1, 'paket_id' => $createdPaketId],
        //         ['name' => "ski ". ($index + 1), 'prodi_id' => 2, 'paket_id' => $createdPaketId],
        //         ['name' => "akidah ". ($index + 1), 'prodi_id' => 3, 'paket_id' => $createdPaketId],
        //     ];

        //     DB::table('paket_details')->insert($paketDetails);
        // }

        // $namaSoal = ['akidah 1', 'fiqih 1', 'ski 1', 'professional 1'];
        // for ($x = 1 ; $x <= count($namaSoal) ; $x++){
        //     $soal = \App\Models\Soal::factory()->create([
        //         'name' => $namaSoal[$x - 1],
        //     ]);
        //     // Membuat 30 SoalDetail
        //     for ($i = 1; $i <= 60; $i++) {
        //         $soalDetail = \App\Models\SoalDetail::factory()->create([
        //             'name' => 'hewan '. $namaSoal[$x - 1] . ' ' .  $i,  // Menambahkan nomor unik ke nama
        //             'soal_id' => $soal->id,
        //         ]);

        //         // Membuat 4 Jawaban untuk setiap SoalDetail
        //         for ($j = 1; $j <= 5; $j++) {
        //             \App\Models\Jawaban::factory()->create([
        //                 'name' => 'jawaban ' . $j,
        //                 'status' => $j === 1,  // Memberikan status true hanya pada jawaban pertama
        //                 'soal_detail_id' => $soalDetail->id,
        //             ]);
        //         }
        //     }
        // }

    }
}
