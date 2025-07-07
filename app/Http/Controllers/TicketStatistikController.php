<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sla;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TicketStatistikController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator']);
    }

    public function index(Request $request)
    {
        $query = Ticket::with('sla')
            ->whereNotNull('start_date')
            ->whereNotNull('end_date');

        // 🔍 Filter Tanggal
        if ($request->filled('from_date')) {
            $query->whereDate('start_date', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('end_date', '<=', $request->to_date);
        }

        // 🔍 Filter SLA
        if ($request->filled('sla_id')) {
            $query->where('sla_id', $request->sla_id);
        }

        // 🔍 Filter Teknisi
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $tickets = $query->get();

        $total = $tickets->count();
        $totalOpen = Ticket::where('status', 'open')->count();
        $sla_ok = 0;
        $sla_miss = 0;

        foreach ($tickets as $ticket) {
            $durasi = Carbon::parse($ticket->start_date)->diffInHours($ticket->end_date);
            $batas = (int) $ticket->sla?->time ?? 0;

            if ($batas === 0) continue;

            if ($durasi <= $batas) {
                $sla_ok++;
            } else {
                $sla_miss++;
            }
        }

        return view('ticket.statistik', [
            'total' => $total,
            'sla_ok' => $sla_ok,
            'sla_miss' => $sla_miss,
            'persen_ok' => $total > 0 ? round(($sla_ok / $total) * 100, 1) : 0,
            'persen_miss' => $total > 0 ? round(($sla_miss / $total) * 100, 1) : 0,
            'slas' => Sla::all(),
            'users' => User::all(),
            'totalOpen' => $totalOpen,
            'request' => $request
        ]);
    }
}
