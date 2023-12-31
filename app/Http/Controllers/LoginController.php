<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role == 2) {
                return redirect()->intended('/dashboard');
            } elseif (Auth::user()->role == 1) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->with('loginError', 'Login Gagal, periksa kembali username atau password anda!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
