<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    public function soal_details()
    {
        return $this->hasMany(SoalDetail::class, 'soal_id', 'id');
    }
}
