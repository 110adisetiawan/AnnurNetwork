<?php

namespace App\Http\Controllers;

use App\Models\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
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
        $priorities = Priority::all();
        return view('priority.index', compact('priorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('priority.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Priority::create($request->all());
        return redirect()->route('priority.index')->with('success', 'Prioritas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Priority $priority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Priority $priority)
    {
        return view('priority.edit', compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Priority $priority)
    {
        $priority->update($request->all());
        return redirect()->route('priority.index')->with('success', 'Prioritas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Priority $priority)
    {
        $priority->delete();
        return redirect()->route('priority.index')->with('success', 'Prioritas berhasil dihapus');
    }
}
