<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanMahasiswa extends Model
{
    use HasFactory;

    public function mahasiswas()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function jawabans()
    {
        return $this->belongsTo(Jawaban::class, 'jawaban_id', 'id');
    }
    
}
