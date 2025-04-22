<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{

    public function showLoginForm () {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Anda berhasil login.');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }
       
    public function logout()
    {
        auth()->logout();
        return redirect('dashboard')->with('success', 'Anda telah logout.');
    }
    
}
