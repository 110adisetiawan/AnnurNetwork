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

    public function loadregister()
    {
        return view('auth.register');
    }



    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->with('success', 'Login Berhasil, Hai ' . Auth::user()->name . '!');
        }

        return redirect()->back()->with('error', 'Email atau Password Salah');
    }

    public function register(Request $request)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);


        // Buat user baru
        $user = new \App\Models\User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole('Karyawan');


        // Login user setelah registrasi
        Auth::login($user);

        return redirect('/')->with('success', 'Registrasi Berhasil, Hai ' . $user->name . '!');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Logout Berhasil');
    }
}
