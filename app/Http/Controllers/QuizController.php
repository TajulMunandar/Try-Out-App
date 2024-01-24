<?php

namespace App\Http\Controllers;

use App\Jobs\QuizJob;
use App\Models\JawabanMahasiswa;
use App\Models\Paket;
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
        $validatedData = $request->validate([
            'jawaban_id.*' => 'required', // Assuming 'jawaban_id' is an array
            'mahasiswa_id' => 'required',
            'paket_detail_id' => 'required',
        ]);


        QuizJob::dispatch($validatedData);

        return redirect('/paket-main')->with('success', 'Hore Kamu Sudah Mengerjakan Quizmu!!');;
    }

    /**
     * Display the specified resource.
     */
    public function show(PaketDetail $quiz)
    {
        $paket = Paket::find($quiz->paket_id);
        $start = $paket->start;
        $end = $paket->end;

        $shuffledSoalDetails = $quiz->paket_soals->flatMap(function ($paketSoal) {
            return $paketSoal->soals->soal_details->shuffle();
        })->all();

        // dd($shuffledSoalDetails);

        return view('main.page.quiz')->with(compact('quiz', 'shuffledSoalDetails', 'start', 'end'));
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
