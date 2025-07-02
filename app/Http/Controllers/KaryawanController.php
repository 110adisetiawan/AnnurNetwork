<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->hasRole('Karyawan')) {
            return redirect('/');
        }
        $karyawans = User::all();
        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('karyawan.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:karyawans',
            'password' => 'required',
            'telegram_id' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'File harus berupa gambar dengan format jpeg, png, jpg, gif!',
            'foto.max' => 'Ukuran file tidak boleh lebih dari 2MB!'
        ]);
        $filepath = public_path('assets/img/karyawan');

        $insert = new User();
        $insert->name = $request->nama;
        $insert->alamat = $request->alamat;
        $insert->no_hp = $request->no_hp;
        $insert->email = $request->email;
        $insert->telegram_id = $request->telegram_id;
        $insert->password = Hash::make($request->password);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($filepath, $filename);
            $insert->foto = $filename;
        }

        $insert->syncRoles(intval($request->role));
        $result = $insert->save();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $karyawan) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $karyawan)
    {
        $roles = Role::all();
        return view('karyawan.edit', compact('karyawan', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $karyawan)
    {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'telegram_id' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'foto' => 'image|mimes:jpeg,png,jpg,gif,bmp|max:2048',
            'status' => 'required',
            'role' => 'required'
        ], [
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'File harus berupa gambar dengan format jpeg, png, jpg, gif!',
            'foto.max' => 'Ukuran file tidak boleh lebih dari 2MB!'
        ]);
        $filepath = public_path('assets/img/karyawan');

        $update = User::find($karyawan->id);
        $update->name = $request->name;
        $update->alamat = $request->alamat;
        $update->no_hp = $request->no_hp;
        $update->telegram_id = $request->telegram_id;
        $update->email = $request->email;
        $update->status = $request->status;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($filepath, $filename);
            $update->foto = $filename;
            if (!is_null($karyawan->foto)) {
                $oldImage = public_path('assets/img/karyawan/' . $karyawan->foto);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $update->foto = $filename;
        }
        $update->syncRoles($request->role);
        $result = $update->save();

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->hasRole('Karyawan')) {
            return redirect()->route('karyawan.edit', $karyawan->id)->with('success', 'Karyawan berhasil diupdate');
        }

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $karyawan)
    {
        $karyawan->delete();
        if (!is_null($karyawan->foto)) {
            $oldImage = public_path('assets/img/karyawan/' . $karyawan->foto);
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
