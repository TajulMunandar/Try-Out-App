<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoalDetail extends Model
{
    use HasFactory;

    public function soals()
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }

    public function jawabans()
    {
        return $this->hasMany(Jawaban::class, 'soal_detail_id', 'id');
    }
}
