<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.page.user.index', [
            'users' => User::latest()->get(),
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
            'nim' => ['required', 'max:16', 'regex:/^[0-9]+$/', 'unique:users'],
            'password' => 'required|max:255',
            'is_admin' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_admin'] = intval($validatedData['is_admin']);

        User::create($validatedData);

        return redirect('/dashboard/user')->with('success', 'User baru berhasil dibuat!');
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
    public function update(Request $request, User $user)
    {
        $rules = [
            'nim' => 'required|max:255',
            'is_admin' => 'required', 
        ];
        
        if ($request->nim != $user->nim) {
            $rules['nim'] = ['required', 'max:16', 'regex:/^[0-9]+$/', 'unique:users'];
        }
        
        $validatedData = $request->validate($rules);
        $validatedData['is_admin'] = intval($validatedData['is_admin']);
        
        $user1 = User::where('id', $user->id)->update($validatedData);
 

        return redirect('/dashboard/user')->with('success', 'User berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::whereId($id)->first();
        User::destroy($id);
        return redirect('/dashboard/user')->with('success', "User dengan NIM $user->nim berhasil dihapus!");
    }

    public function resetPasswordAdmin(Request $request)
    {
        $rules = [
            'password' => 'required|max:255',
        ];

        if ($request->password == $request->password2) {
            $validatedData = $request->validate($rules);
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::where('id', $request->id)->update($validatedData);
        } else {
            return back()->with('failed', 'Konfirmasi password tidak sesuai');
        }

        return redirect('/dashboard/user')->with('success', 'Password berhasil direset!');
    }

}
