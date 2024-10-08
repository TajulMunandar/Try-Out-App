<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\SoalDetail;
use Illuminate\Http\Request;

class DashboardSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.paket-soal.soal.index', [
            'soals' => Soal::latest()->get(),
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
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255'
            ]); 
    
            Soal::create($validatedData);
    
            return redirect('/dashboard/paket-soal/soal')->with('success', 'Soal berhasil dibuat');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/dashboard/paket-soal/soal')->with('failed', $e->getMessage());
        } catch (\Exception $e) {
            return redirect('/dashboard/paket-soal/soal')->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('dashboard.page.paket-soal.soal.soal-detail.index', [
            'soal_details' => SoalDetail::with('soals')->where('soal_id', $id)->get(),
            'soal_id' => $id
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
        try {
            $rules = [
                'name' => 'required|max:255',
            ];
    
            $validatedData = $request->validate($rules);
     
            Soal::where('id', $id)->update($validatedData);
            return redirect('/dashboard/paket-soal/soal')->with('success', 'Soal berhasil diubah');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/dashboard/paket-soal/soal')->with('failed', $e->getMessage());
        } catch (\Exception $e) {
            return redirect('/dashboard/paket-soal/soal')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $soal = Soal::whereId($id)->first();
            Soal::destroy($id);
            return redirect('/dashboard/paket-soal/soal')->with('success', "Soal $soal->name berhasil dihapus!");
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/paket-soal/soal')->with('failed', "Soal $soal->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
