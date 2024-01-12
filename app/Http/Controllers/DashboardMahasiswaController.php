<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.mahasiswa.index', [
            'mahasiswas' => Mahasiswa::with('prodis')->latest()->get(),
            'prodis' => Prodi::latest()->get(),
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
        $validatedDataMahasiswa = $request->validate([ 
            'name' => 'required|max:255',
            'nim' => ['required', 'max:16', 'regex:/^[0-9]+$/', 'unique:users'],
            'kelas' => 'required|max:255',
            'prodi_id' => 'required'
        ]);
        
        $validatedData['nim'] = $request->nim;
        $validatedData['password'] = Hash::make($request->nim);
        $validatedData['is_admin'] = 0;
        $validatedData['username'] = strtolower(str_replace(' ', '', $request->name));

        $user = User::create($validatedData);

        $validatedDataMahasiswa['user_id'] = $user->id;

        Mahasiswa::create($validatedDataMahasiswa);
 

        return redirect('/dashboard/mahasiswa')->with('success', 'Mahasiswa baru berhasil dibuat!');
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
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $rules = [
            'name' => 'required|max:255', 
            'kelas' => 'required|max:255',
            'nim' => 'required|max:255',
            'prodi_id' => 'required'
        ];

        $rules2 = [
            'nim' => 'required|max:255'
        ];
        
        
        $validatedData2 = $request->validate($rules2);
        
        User::where('nim', $mahasiswa->nim)->update($validatedData2);

        $validatedData = $request->validate($rules);
       
        Mahasiswa::where('id', $mahasiswa->id)->update($validatedData);
  
        return redirect('/dashboard/mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $mahasiswa = Mahasiswa::whereId($id)->first();
            Mahasiswa::destroy($id);
            User::where('nim', $mahasiswa->nim)->delete();
            return redirect('/dashboard/mahasiswa')->with('success', "Mahasiswa dengan Nama $mahasiswa->name berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/mahasiswa')->with('failed', "Mahasiswa $mahasiswa->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
