<?php

namespace App\Imports;

use App\Models\Jawaban;
use App\Models\SoalDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    use Importable;
    protected $soal_id; // Properti untuk menyimpan soal_id

    public function __construct($soal_id)
    {
        $this->soal_id = $soal_id;
    }

    public function Collection(Collection $rows)
    {
        foreach($rows as $row){
            $data = [
                [$row['jawaban_benar'], 1],
                [$row['jawaban_kedua'], 0],
                [$row['jawaban_ketiga'], 0],
                [$row['jawaban_keempat'], 0]
            ];
        
            shuffle($data);

            $soal_detail = SoalDetail::create([
                'name' => $row['pertanyaan'],
                'soal_id' => $this->soal_id
            ]);
    
            foreach ($data as $value) {
                $status = false;
                if ($value[1]) {
                    $status = true;
                }

                Jawaban::create([
                    'name' => $value[0],
                    'status' => $status,
                    'soal_detail_id' => $soal_detail->id
                ]);
            }
    
            Jawaban::create([
                'name' => 'Tidak Menjawab',
                'status' => false,
                'soal_detail_id' => $soal_detail->id
            ]);
        }
    }
}
