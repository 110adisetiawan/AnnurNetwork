<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loadlogin()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Login Berhasil');
        }

        return redirect()->back()->with('error', 'Email atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout Berhasil');
    }
}
