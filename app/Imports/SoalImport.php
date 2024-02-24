<?php

namespace App\Imports;

use App\Models\Jawaban;
use App\Models\SoalDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;

class SoalImport implements ToModel
{
    /**
    * @param Collection $collection
    */

    protected $soal_id; // Properti untuk menyimpan soal_id

    public function __construct($soal_id)
    {
        $this->soal_id = $soal_id;
    }

    public function model(array $row)
    {
        $soal_detail = SoalDetail::create([
            'name' => $row[0], // Sesuaikan dengan kolom yang sesuai di template Excel
            'soal_id' => $this->soal_id
        ]);

        foreach ($row[1] as $key => $value) {
            $status = false;
            if ($key == $row[2]) {
                $status = true;
            }
            Jawaban::create([
                'name' => $value,
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
