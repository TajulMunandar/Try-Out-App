<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'Teknik Informatika',
        ]);

        \App\Models\User::factory()->create([
            'nim' => '2020573010006',
            'password' => '2020573010006',
            'username' => 'alvinsyahri',
            'is_admin' => 0,
        ]);

        \App\Models\Mahasiswa::factory()->create([
            'nim' => '2020573010006',
            'name' => 'Alvin Syahri',
            'kelas' => '4B',
            'user_id' => 2,
            'prodi_id' => 1,
        ]);

        \App\Models\Paket::factory()->create([
            'name' => 'Paket 1',
            'start' => now(),
            'end' => now()->addDays(7),
        ]);
        
        \App\Models\PaketDetail::factory()->create([
            'name' => 'akidah 1',
            'paket_id' => 1,
            'prodi_id' => 1,
        ]);

        $namaSoal = ['akidah 1', 'fiqih 1', 'ski 1', 'professional 1'];
        for ($x = 1 ; $x <= count($namaSoal) ; $x++){
            $soal = \App\Models\Soal::factory()->create([
                'name' => $namaSoal[$x - 1],
            ]);
            // Membuat 30 SoalDetail
            for ($i = 1; $i <= 60; $i++) {
                $soalDetail = \App\Models\SoalDetail::factory()->create([
                    'name' => 'hewan ' . $i,  // Menambahkan nomor unik ke nama
                    'soal_id' => $soal->id,
                ]);
    
                // Membuat 4 Jawaban untuk setiap SoalDetail
                for ($j = 1; $j <= 4; $j++) {
                    \App\Models\Jawaban::factory()->create([
                        'name' => 'jawaban ' . $j,
                        'status' => $j === 1,  // Memberikan status true hanya pada jawaban pertama
                        'soal_detail_id' => $soalDetail->id,
                    ]);
                }
            }
        }

    }
}
