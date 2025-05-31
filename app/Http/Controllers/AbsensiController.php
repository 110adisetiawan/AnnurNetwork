<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validate the request data
        $request->validate([
            'user_id' => 'required',
            'status' => 'required|string|max:255',
        ]);

        // Create a new Absensi record
        $absensi = new Absensi();
        $carbon = Carbon::now();
        $time = $carbon->now();
        $absensi->masuk = $time;
        $absensi->user_id = $request->user_id;
        $absensi->keterangan = $request->status;
        $absensi->save();

        // Return a response
        return redirect()->back()->with('success', 'Berhasil Absen Masuk');
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
    public function update(Request $request, Absensi $absensi)
    {
        $request->validate([
            'user_id' => 'required'
        ]);

        $update = Absensi::find($absensi->id);
        $carbon = Carbon::now();
        $time = $carbon->now();
        $update->pulang = $time;
        $result = $update->save();
        return redirect()->back()->with('success', 'Karyawan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
