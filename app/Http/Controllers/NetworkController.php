<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkController extends Controller
{
    public function __construct()
    {

        $this->middleware(['role_or_permission:data-edit']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $networks = Network::all()->sortByDesc('created_at');
        return view('network.index', compact('networks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if ($this->middleware(['role_or_permission:data-create'])) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }
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
        if ($this->middleware(['role_or_permission:data-delete'])) {
            abort(403, 'Anda tidak punya akses ke halaman ini.');
        }
        $network->delete();
        return redirect()->route('network.index')->with('success', 'Data device berhasil dihapus');
    }
}
