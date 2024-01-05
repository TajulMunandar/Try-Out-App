<?php

namespace App\Http\Controllers;

use App\Models\PaketDetail;
use App\Models\PaketSoal;
use App\Models\Soal;
use Illuminate\Http\Request;

class DashboardEnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.paket-soal.paket.enroll.index', [
            'enrols' => PaketSoal::latest()->get(),
            'soals' => Soal::latest()->get(),
            'pakets' => PaketDetail::latest()->get(),
        ]);
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
            'soal_id' => 'required|max:255',
            'paket_detail_id' => 'required|max:255'
        ]);

        PaketSoal::create($validatedData);

        return redirect('/dashboard/paket-soal/enrol')->with('success', 'Enroll Paket berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, PaketSoal $enrol)
    {
        $rules = [
            'soal_id' => 'required|max:255',
            'paket_detail_id' => 'required|max:255'
        ];

        $validatedData = $request->validate($rules);

        PaketSoal::where('id', $enrol->id)->update($validatedData);
        return redirect('/dashboard/paket-soal/enrol')->with('success', 'Enroll Paket berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaketSoal $enrol)
    {
        try{
            PaketSoal::destroy($enrol->id);
            return redirect('/dashboard/paket-soal/enrol')->with('success', "Enroll Paket " . $enrol->soals->name . " berhasil dihapus!");
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/paket-soal/enrol')->with('failed', "Enroll Paket " . $enrol->soals->name . " tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
