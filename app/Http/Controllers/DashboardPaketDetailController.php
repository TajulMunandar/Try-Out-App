<?php

namespace App\Http\Controllers;

use App\Models\PaketDetail;
use Illuminate\Http\Request;

class DashboardPaketDetailController extends Controller
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
            'name' => 'required|max:255',
            'paket_id' => 'required',
            'prodi_id' => 'required'
        ]); 

        PaketDetail::create($validatedData);

        return redirect("/dashboard/paket-soal/paket/{$request->paket_id}")->with('success', 'Paket Detail berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
            'prodi_id' => 'required'
        ];

        $validatedData = $request->validate($rules);
 
        PaketDetail::where('id', $id)->update($validatedData);
        return redirect("/dashboard/paket-soal/paket/{$request->paket_id}")->with('success', 'Paket berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $paket_detail = PaketDetail::whereId($id)->first();
            PaketDetail::destroy($id);
            return redirect("/dashboard/paket-soal/paket/{$paket_detail->paket_id}")->with('success', "Paket $paket_detail->name berhasil dihapus!");
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect("/dashboard/paket-soal/paket/{$paket_detail->paket_id}")->with('failed', "Paket $paket_detail->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
