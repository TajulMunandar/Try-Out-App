<?php

namespace App\Http\Controllers;

use App\Models\ViewScore;
use Illuminate\Http\Request;

class DashboardPenilaianController extends Controller
{
    public function index(){
        // dd(ViewScore::latest()->get());
        return view('dashboard.page.penilaian.index', [
            'scores' => ViewScore::latest()->get()
        ]);
    }
}
