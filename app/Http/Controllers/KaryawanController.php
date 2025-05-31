<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


class KaryawanController extends Controller
{
    public function __construct()
    {

        $this->middleware(['role_or_permission:data-create|data-delete']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

    public function editPassword(string $id)
    {

        $karyawan = User::find($id);
        return view('karyawan.editPassword', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
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
        $update->name = $request->nama;
        $update->alamat = $request->alamat;
        $update->no_hp = $request->no_hp;
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
