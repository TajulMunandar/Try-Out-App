<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;

    public function soal_details()
    {
        return $this->belongsTo(SoalDetail::class, 'soal_detail_id', 'id');
    }

    public function jawaban_mahasiswas()
    {
        return $this->hasMany(JawabanMahasiswa::class, 'jawaban_id', 'id');
    }
}
