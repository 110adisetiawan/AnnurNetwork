<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\Absensi;
use App\Models\Network;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $absensi = Absensi::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::today())->first();
        $ticket = Ticket::all()->count();
        $tickets = Ticket::all();
        $karyawan = Karyawan::all()->count();
        $olt = Network::all()->count();
        $now = Carbon::now()->translatedFormat('l d F Y');
        return view(
            'dashboard',
            compact('absensi', 'ticket', 'tickets', 'karyawan', 'olt', 'now')
        );
    }
}
