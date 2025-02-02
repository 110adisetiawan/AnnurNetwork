<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $networks = Network::all();
        return view('network.index', compact('networks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('network.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Network::create($request->all());
        return redirect()->route('network.index')->with('success', 'Data device berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Network $network)
    {
        return view('network.show', compact('network'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Network $network)
    {
        return view('network.edit', compact('network'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Network $network)
    {
        $network->update($request->all());
        return redirect()->route('network.index')->with('success', 'Data device berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Network $network)
    {
        $network->delete();
        return redirect()->route('network.index')->with('success', 'Data device berhasil dihapus');
    }
}
