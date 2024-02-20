<?php

namespace App\Http\Controllers;

use App\Models\PaketDetail;
use App\Models\ViewScore;
use Illuminate\Http\Request;

class DashboardPenilaianController extends Controller
{
    public function index()
    {

        $paket_details = PaketDetail::latest()->get();

        $firstPaketDetails = PaketDetail::first();

        $penilaian = ViewScore::where('paket_detail_id', $firstPaketDetails->id)->latest()->get();

        if (auth()->user()->is_admin == 2) {
            $paket_details = PaketDetail::where('prodi_id', auth()->user()->dosens->prodi_id)->latest()->get();
            $firstPaketDetails = PaketDetail::where('prodi_id', auth()->user()->dosens->prodi_id)->first();
            $penilaian = ViewScore::where('mahasiswa_prodi_id', auth()->user()->dosens->prodi_id)->where('paket_detail_id', $firstPaketDetails->id)->latest()->get();
        }
        
        dd($penilaian);
        return view('dashboard.page.penilaian.index', [
            'scores' => $penilaian,
            'paket_details' => $paket_details
        ]);
    }
}
