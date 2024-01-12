<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class DashboardProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.prodi.index', [
            'prodis' => Prodi::latest()->get()
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
            'name' => 'required|max:255'
        ]);

        Prodi::create($validatedData);

        return redirect('/dashboard/prodi')->with('success', 'Mata Kuliah berhasil dibuat');
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
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

        $validatedData = $request->validate($rules);

        Prodi::where('id', $id)->update($validatedData);
        return redirect('/dashboard/prodi')->with('success', 'Mata Kuliah berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $prodi = Prodi::whereId($id)->first();
            Prodi::destroy($id);
            return redirect('/dashboard/prodi')->with('success', "Mata Kuliah $prodi->name berhasil dihapus!");
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/prodi')->with('failed', "Mata Kuliah $prodi->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
