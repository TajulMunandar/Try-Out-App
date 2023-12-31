<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    public function paket_details()
    {
        return $this->hasMany(PaketDetail::class, 'paket_id', 'id');
    }
}
