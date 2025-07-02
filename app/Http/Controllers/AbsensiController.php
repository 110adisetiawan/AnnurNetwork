<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AbsensiReportExport;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{

    public function exportPdf(Request $request)
    {
        $absensis = $this->getFilteredReports($request);
        $pdf = Pdf::loadView('absensi.export_pdf', compact('absensis'));
        return $pdf->download('absensi_' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'absensi_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new AbsensiReportExport($request), $filename);
    }

    private function getFilteredReports(Request $request)
    {
        $query = Absensi::with('user')->orderBy('created_at', 'desc');

        if ($request->filter === 'date' && $request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('created_at', [$request->from_date, $request->to_date]);
        } elseif ($request->filter === 'month') {
            $month = $request->get('month', now()->month);
            $year  = $request->get('year', now()->year);

            $query->whereMonth('created_at', $month)
                ->whereYear('created_at', $year);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        return $query->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterMode = $request->get('filter');
        $query = Absensi::query()->with('user');

        if ($request->filter === 'month') {
            if ($request->filled('month')) {
                $query->whereMonth('created_at', $request->month);
            }

            if ($request->filled('year')) {
                $query->whereYear('created_at', $request->year);
            }
        }

        if ($request->filter === 'date') {
            if ($request->filled('from_date')) {
                $query->whereDate('created_at', '>=', $request->from_date);
            }

            if ($request->filled('to_date')) {
                $query->whereDate('created_at', '<=', $request->to_date);
            }
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $absensis = $query->orderBy('created_at', 'desc')->get();
        $users = User::all();

        return view('absensi.index', compact('absensis', 'users'));
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
        return redirect()->back()->with('success', 'Berhasil Absen Pulang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
