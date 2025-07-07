<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Karyawan'])->only(['index', 'edit']);
        $this->middleware(['role:Administrator'])->only(['create', 'store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $networks = Network::all()->sortByDesc('created_at');
        return view('network.index', compact('networks'));
    }

    public function ping(Network $network)
    {
        $ip = $network->ip_address;

        $ping = shell_exec(PHP_OS_FAMILY === 'Windows'
            ? "ping -n 1 -w 1000 $ip"
            : "ping -c 1 -W 1 $ip");

        $isOnline = str_contains($ping, 'TTL') || str_contains($ping, 'ttl');

        $network->status = $isOnline ? 'online' : 'offline';
        $network->save();

        return response()->json([
            'status' => $network->status,
            'message' => "{$network->device_name} is " . strtoupper($network->status),
            'raw' => $ping // ini untuk bantu debug output asli dari ping
        ]);
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
