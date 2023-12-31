<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'prodi_id', 'id');
    }

    public function paket_details()
    {
        return $this->hasMany(PaketDetail::class, 'paket_id', 'id');
    }
}
