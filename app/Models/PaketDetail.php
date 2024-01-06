<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketDetail extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function pakets()
    {
        return $this->belongsTo(Paket::class, 'paket_id', 'id');
    }

    public function prodis()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }

    public function paket_soals()
    {
        return $this->hasMany(PaketSoal::class, 'paket_detail_id', 'id');
    }

    public function jawaban_mahasiswas()
    {
        return $this->hasMany(JawabanMahasiswa::class, 'paket_detail_id', 'id');
    }
}
