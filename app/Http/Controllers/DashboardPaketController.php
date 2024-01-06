<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\PaketDetail;
use App\Models\Prodi;
use Illuminate\Http\Request;

class DashboardPaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.paket-soal.paket.index', [
            'pakets' => Paket::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'start' => 'required',
            'end' => 'required'
        ]); 

        Paket::create($validatedData);

        return redirect('/dashboard/paket-soal/paket')->with('success', 'Paket berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.page.paket-soal.paket.paket-detail.index', [
            'paket_details' => PaketDetail::with('prodis')->where('paket_id', $id)->latest()->get(),
            'prodis' => Prodi::latest()->get(),
            'paket_id' => $id
        ]);
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
        $rules = [
            'name' => 'required|max:255',
            'start' => 'required',
            'end' => 'required'
        ];

        $validatedData = $request->validate($rules);
 
        Paket::where('id', $id)->update($validatedData);
        return redirect('/dashboard/paket-soal/paket')->with('success', 'Paket berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $paket = Paket::whereId($id)->first();
            Paket::destroy($id);
            return redirect('/dashboard/paket-soal/paket')->with('success', "Paket $paket->name berhasil dihapus!");
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/paket-soal/paket')->with('failed', "Paket $paket->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
