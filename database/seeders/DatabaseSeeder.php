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
        // \App\Models\User::factory(10)->create();

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

        \App\Models\Soal::factory()->create([
            'name' => 'akidah 1',
        ]);
    }
}
