<?php

namespace App\Http\Controllers;

use App\Models\ViewScore;
use Illuminate\Http\Request;

class DashboardPenilaianController extends Controller
{
    public function index(){
        
        $penilaian = ViewScore::latest();

        if (auth()->user()->is_admin == 2) {
            $penilaian->where('mahasiswa_prodi_id', auth()->user()->dosens->prodi_id);
        }

        $penilaian = $penilaian->get();

        return view('dashboard.page.penilaian.index', [
            'scores' => $penilaian
        ]);
    }
}
