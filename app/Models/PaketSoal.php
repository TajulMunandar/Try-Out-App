<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;

    public function soals()
    {
        return $this->belongsTo(Soal::class, 'soal_id', 'id');
    }

    public function paket_details()
    {
        return $this->belongsTo(PaketDetail::class, 'paket_detail_id', 'id');
    }
}
