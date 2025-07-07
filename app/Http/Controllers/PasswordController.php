<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Karyawan'])->only(['index', 'edit', 'update']);
        $this->middleware(['role:Administrator'])->only(['create', 'store', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index() {}

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
        //
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
        $karyawan = User::find($id);
        return view('karyawan.editPassword', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (Auth::user()->hasRole('Administrator')) {

            $karyawan = User::find($id);
            # Validation
            $request->validate([
                'new_password' => 'required|confirmed',
            ], [
                'new_password.required' => 'Harap masukkan password baru!',
                'new_password.confirmed' => 'Password baru tidak cocok!',
            ]);

            #Update the new Password
            $karyawan->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->route('karyawan.edit', $karyawan->id)->with('success', "Password changed successfully!");
        } else {
            #Match The Old Password
            $karyawan = User::find($id);
            if (!Hash::check($request->current_password, $karyawan->password)) {
                return back()->withErrors(['error' => 'Password lama tidak cocok!']);
            }
            # Validation
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|confirmed',
            ], [
                'current_password.required' => 'Harap masukkan password lama!',
                'new_password.required' => 'Harap masukkan password baru!',
                'new_password.confirmed' => 'Password baru tidak cocok!',
            ]);

            #Update the new Password
            $karyawan->update([
                'password' => Hash::make($request->new_password)
            ]);

            return redirect()->route('karyawan.edit', $karyawan->id)->with('success', "Password changed successfully!");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
