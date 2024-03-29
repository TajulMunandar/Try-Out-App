<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanMahasiswa extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function mahasiswas()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function jawabans()
    {
        return $this->belongsTo(Jawaban::class, 'jawaban_id', 'id');
    }

    public function paket_details()
    {
        return $this->belongsTo(PaketDetail::class, 'paket_detail_id', 'id');
    }

    function checkIfAnswerExists($paketId, $userId)
    {
        return JawabanMahasiswa::where('paket_detail_id', $paketId)
            ->where('mahasiswa_id', $userId)
            ->exists();
    }
}
