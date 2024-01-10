<?php

namespace App\Http\Controllers;

use App\Models\PaketDetail;
use App\Models\PaketSoal;
use App\Models\Soal;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaketDetail $quiz)
    {
        $allSoalDetails = collect();

        foreach ($quiz->paket_soals as $paketSoal) {
            $allSoalDetails = $allSoalDetails->merge($paketSoal->soals->soal_details);
        }

        $shuffledSoalDetails = $allSoalDetails->shuffle();

        // dd($shuffledSoalDetails);

        return view('main.page.quiz')->with(compact('quiz', 'shuffledSoalDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
