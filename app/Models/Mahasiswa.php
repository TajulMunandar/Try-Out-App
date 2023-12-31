<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function prodis()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function jawaban_mahasiswas()
    {
        return $this->hasMany(JawabanMahasiswa::class, 'mahasiswa_id', 'id');
    }
}
