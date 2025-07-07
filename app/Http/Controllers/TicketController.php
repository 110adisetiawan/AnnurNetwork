<?php

namespace App\Http\Controllers;

use App\Models\App_Setting;
use Carbon\Carbon;
use App\Models\SLA;
use App\Models\Task;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Priority;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Karyawan'])->only(['index', 'edit', 'update']);
        $this->middleware(['role:Administrator'])->only(['create', 'store', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->hasRole('Karyawan')) {
            $userId = Auth::user()->id;
            $tickets = Ticket::where('user_id', $userId)->get();
            return view('ticket.index', compact('tickets'));
        }

        $tickets = Ticket::all()->sortByDesc('created_at');
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->hasPermissionTo('data-master')) {
            $karyawans = User::all();
            $priorities = Priority::all();
            $sla = SLA::all();
            $tasks = Task::all();

            return view('ticket.create', compact('karyawans', 'priorities', 'sla', 'tasks'));
        }

        abort(403, 'Anda tidak punya akses ke halaman ini.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'sla_id' => 'required',
            'priority_id' => 'required',
            'task_id' => 'required',
            'customer_name' => 'required',
            'customer_address' => 'required',
            'image_address' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'latitude_ticket' => 'required',
            'longitude_ticket' => 'required'
        ], [
            'image_address.image' => 'File harus berupa gambar!',
            'image_address.mimes' => 'File harus berupa gambar dengan format jpeg, png, jpg, gif!',
            'image_address.max' => 'Ukuran file tidak boleh lebih dari 2MB!'
        ]);
        $insert = new Ticket();

        $app_setting = App_Setting::find(1);
        if ($app_setting->telegram_alert == 'active') {

            $telegramsend = User::find($request->user_id);
            $task = Task::find($request->task_id);
            $sla = SLA::find($request->sla_id);
            $priority = Priority::find($request->priority_id);
            $now = Carbon::now()->translatedFormat('l d F Y');
            $time = Carbon::now()->translatedFormat('g:i:s');


            $users = User::role('Administrator')->get();

            $adminMessage = "!ADMIN ALERT NEW TIKET!\n\n====Detail Tiket====\nTanggal : $now \nJam: $time\nNama Teknisi: $telegramsend->name \nNama Pelanggan: $request->customer_name \nAlamat Pelanggan: $request->customer_address \nTugas: $task->nama_tugas \nSLA: $sla->nama_sla \nPrioritas: $priority->nama_prioritas\n*********************\nBuka website untuk melihat detail tiket: https://annurnetwork.com/ticket\n\nTerima kasih.";
            $message = "!NEW TIKET!\nhalo $telegramsend->name,\nAnda menerima tiket baru\n\n====Detail Tiket====\nTanggal : $now \nJam: $time\nNama Pelanggan: $request->customer_name \nAlamat Pelanggan: $request->customer_address \nTugas: $task->nama_tugas \nSLA: $sla->nama_sla \nPrioritas: $priority->nama_prioritas\n*********************\nBuka website untuk melihat detail tiket: https://annurnetwork.com/ticket\n\nTerima kasih.";

            Telegram::sendMessage([
                'chat_id' => $users[0]->telegram_id,
                'text' => $adminMessage,
            ]);
            Telegram::sendMessage([
                'chat_id' => $telegramsend->telegram_id,
                'text' => $message,
            ]);
        }


        $filepath = public_path('assets/img/customer');

        $insert->user_id = $request->user_id;
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
        $karyawans = User::all();
        return view('ticket.edit', compact('ticket', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        if ($request->only('user_id')) {

            $request->validate([
                'user_id' => 'required'
            ], [
                'user_id.required' => 'Teknisi harus dipilih!'
            ]);

            $app_setting = App_Setting::find(1);
            if ($app_setting->telegram_alert == 'active') {

                $telegramsend = User::find($ticket->user_id);
                $task = Task::find($ticket->task_id);
                $sla = SLA::find($ticket->sla_id);
                $priority = Priority::find($ticket->priority_id);
                $update = Ticket::find($ticket->id);

                $message = "!NEW TIKET! - *Backup Team*\nhalo $telegramsend->name,\nAnda menerima tiket baru\n\n====Detail Tiket====\nTicket ID: $ticket->id\nTanggal : $ticket->created_at \nNama Pelanggan: $ticket->customer_name \nAlamat Pelanggan: $ticket->customer_address \nTugas: $task->nama_tugas \nSLA: $sla->nama_sla \nPrioritas: $priority->nama_prioritas\n*********************\nBuka website untuk melihat detail tiket: https://annurnetwork.com/ticket\n\nTerima kasih.";

                Telegram::sendMessage([
                    'chat_id' => $telegramsend->telegram_id,
                    'text' => $message,
                ]);
            }
            $update->user_id = $request->user_id;

            $update->save();
            return redirect()->route('ticket.edit', $ticket->id)->with('success', 'Teknisi berhasil diubah.');
        }
        if ($request->only('status')) {
            if ($request->status == 'onprogress') {
                $carbon = Carbon::now();
                $time = $carbon->now();
                $update = Ticket::find($ticket->id);
                $update->status = $request->status;
                $update->start_date = $time;
                $update->save();
                return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
            }
        } else if ($request->has('close_ticket')) {
            $request->validate([
                'image_task' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'latitude_task' => 'required',
                'longitude_task' => 'required'
            ], [
                'image_task.image' => 'File harus berupa gambar!',
                'image_task.mimes' => 'File harus berupa gambar dengan format jpeg, png, jpg, gif!',
                'image_task.max' => 'Ukuran file tidak boleh lebih dari 2MB!'
            ]);

            $update = Ticket::find($ticket->id);
            $carbon = Carbon::now();
            $time = $carbon->now();

            $filepath = public_path('assets/img/ticket_task');

            if ($request->hasFile('image_task')) {
                $file = $request->file('image_task');
                $filename = $update->user->name . '.' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($filepath, $filename);
                $update->image_task = $filename;
            }

            $update->status = $request->status;
            $update->latitude_task = $request->latitude_task;
            $update->longitude_task = $request->longitude_task;
            $update->closed_by = $update->user->name;
            $update->end_date = $time;
            $update->note = $request->note;
            $update->status = 'closed';

            $app_setting = App_Setting::find(1);
            if ($app_setting->telegram_alert == 'active') {

                $user = User::find($ticket->user_id);
                $users = User::role('Administrator')->get();

                $adminMessage = "!ADMIN ALERT CLOSE TIKET!\n\n====Detail Tiket====\nTicket ID: $ticket->id\nTicket Open : $ticket->created_at\nTicket Closed : $time \nClosed By: $user->name\n*********************\nBuka website untuk melihat detail tiket: https://annurnetwork.com/ticket\n\nTerima kasih.";

                $message = "!TIKET CLOSED NOTIFICATION!\n\n====Detail Tiket====\nTicket ID: $ticket->id\nTicket Open : $ticket->created_at\nTicket Closed : $time \nClosed By: $user->name\n*********************\nBuka website untuk melihat detail tiket: https://annurnetwork.com/ticket\n\nTerima kasih.";

                Telegram::sendMessage([
                    'chat_id' => $user->telegram_id,
                    'text' => $message,
                ]);
                Telegram::sendMessage([
                    'chat_id' => $users[0]->telegram_id,
                    'text' => $adminMessage,
                ]);
            }

            $update->save();
            return redirect()->route('ticket.index')->with('success', 'Ticket close successfully.');
        } else {
            $ticket->update($request->all());
            return redirect()->route('ticket.index')->with('success', 'Ticket updated successfully.');
        }
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
