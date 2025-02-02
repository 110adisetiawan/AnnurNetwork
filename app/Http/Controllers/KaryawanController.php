<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.index', compact('karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
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

        $insert = new Karyawan();
        $insert->nama = $request->nama;
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

        $result = $insert->save();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    public function editPassword(string $id)
    {

        $karyawan = Karyawan::find($id);
        return view('karyawan.editPassword', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'foto' => 'image|mimes:jpeg,png,jpg,gif,bmp|max:2048',
            'status' => 'required',
        ], [
            'foto.image' => 'File harus berupa gambar!',
            'foto.mimes' => 'File harus berupa gambar dengan format jpeg, png, jpg, gif!',
            'foto.max' => 'Ukuran file tidak boleh lebih dari 2MB!'
        ]);
        $filepath = public_path('assets/img/karyawan');

        $update = Karyawan::find($karyawan->id);
        $update->nama = $request->nama;
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

        $result = $update->save();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
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
