<?php

namespace App\Http\Controllers;

use App\Models\SLA;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Karyawan;
use App\Models\Priority;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all()->sortByDesc('created_at');
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        $priorities = Priority::all();
        $sla = SLA::all();
        $tasks = Task::all();
        return view('ticket.create', compact('karyawans', 'priorities', 'sla', 'tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required',
            'sla_id' => 'required',
            'priority_id' => 'required',
            'task_id' => 'required',
            'customer_name' => 'required',
            'customer_address' => 'required',
            'image_address' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude_ticket' => 'required',
            'longitude_ticket' => 'required'
        ], [
            'image_address.image' => 'File harus berupa gambar!',
            'image_address.mimes' => 'File harus berupa gambar dengan format jpeg, png, jpg, gif!',
            'image_address.max' => 'Ukuran file tidak boleh lebih dari 2MB!'
        ]);

        $filepath = public_path('assets/img/customer');

        $insert = new Ticket();
        $insert->karyawan_id = $request->karyawan_id;
        $insert->sla_id = $request->sla_id;
        $insert->priority_id = $request->priority_id;
        $insert->task_id = $request->task_id;
        $insert->customer_name = $request->customer_name;
        $insert->customer_address = $request->customer_address;
        $insert->latitude_ticket = $request->latitude_ticket;
        $insert->longitude_ticket = $request->longitude_ticket;


        if ($request->hasFile('image_address')) {
            $file = $request->file('image_address');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move($filepath, $filename);
            $insert->image_address = $filename;
        }

        $result = $insert->save();
        return redirect()->route('ticket.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $ticket->update($request->all());
        return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('ticket.index')->with('success', 'Ticket deleted successfully.');
    }
}
