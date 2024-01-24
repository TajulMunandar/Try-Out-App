<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.dosen.index', [
            'dosens' => Dosen::with('prodis')->latest()->get(),
            'prodis' => Prodi::latest()->get(),
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
        try {
            $validatedDataMahasiswa = $request->validate([ 
                'name' => 'required|max:255',
                'nim' => ['required', 'max:16', 'regex:/^[0-9]+$/', 'unique:users'],
                'kelas' => 'required|max:255',
                'prodi_id' => 'required'
            ]);
            
            $validatedData['nim'] = $request->nim;
            $validatedData['password'] = Hash::make($request->nim);
            $validatedData['is_admin'] = 2;
            $validatedData['username'] = strtolower(str_replace(' ', '', $request->name));
    
            $user = User::create($validatedData);
    
            $validatedDataMahasiswa['user_id'] = $user->id;
    
            Dosen::create($validatedDataMahasiswa);
    
            return redirect('/dashboard/dosen')->with('success', 'Dosen baru berhasil dibuat!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/dashboard/dosen')->with('failed', $e->getMessage());
        } catch (\Exception $e) {
            return redirect('/dashboard/dosen')->with('failed', $e->getMessage());
        }
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
    public function update(Request $request, Dosen $dosen)
    {
        try {
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
            
            User::where('nim', $dosen->nim)->update($validatedData2);
    
            $validatedData = $request->validate($rules);
           
            Dosen::where('id', $dosen->id)->update($validatedData);
      
            return redirect('/dashboard/dosen')->with('success', 'Dosen berhasil diperbarui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect('/dashboard/dosen')->with('failed', $e->getMessage());
        } catch (\Exception $e) {
            return redirect('/dashboard/dosen')->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $dosen = Dosen::whereId($id)->first();
            Dosen::destroy($id);
            User::where('nim', $dosen->nim)->delete();
            return redirect('/dashboard/dosen')->with('success', "Dosen dengan Nama $dosen->name berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/dosen')->with('failed', "Dosen $dosen->name tidak bisa dihapus karena sedang digunakan!");
        }
    }
}
