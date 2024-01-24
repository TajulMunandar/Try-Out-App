<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function soal_details()
    {
        return $this->hasMany(SoalDetail::class, 'soal_id', 'id');
    }

    public function paket_soal()
    {
        return $this->hasMany(PaketSoal::class, 'soal_id', 'id');
    }
}
