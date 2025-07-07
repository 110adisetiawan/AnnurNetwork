<?php

namespace App\Http\Controllers;

use App\Models\SLA;
use Illuminate\Http\Request;

class SLAController extends Controller
{
    public function __construct()
    {

        $this->middleware(['role:Administrator']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sla = SLA::all();
        return view('sla.index', compact('sla'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sla.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_sla' => 'required',
            'description' => 'required',
            'time' => 'required|regex:/^[0-9]+$/',
        ]);

        SLA::create($request->all());
        return redirect()->route('sla.index')
            ->with('success', 'SLA berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SLA $sla)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SLA $sla)
    {
        return view('sla.edit', compact('sla'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SLA $sla)
    {
        $request->validate([
            'nama_sla' => 'required',
            'description' => 'required',
            'time' => 'required',
        ]);

        $sla->update($request->all());

        return redirect()->route('sla.index')
            ->with('success', 'SLA berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SLA $sla)
    {
        $sla->delete();

        return redirect()->route('sla.index')
            ->with('success', 'SLA berhasil dihapus.');
    }
}
