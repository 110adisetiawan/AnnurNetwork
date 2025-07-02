<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromView;


class AbsensiReportExport implements FromView
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Absensi::with('user')->orderBy('created_at', 'desc');

        if ($this->request->filter === 'date' && $this->request->filled('from_date') && $this->request->filled('to_date')) {
            $query->whereBetween('created_at', [$this->request->from_date, $this->request->to_date]);
        } elseif ($this->request->filter === 'month') {
            $query->whereMonth('created_at', $this->request->month ?? now()->month)
                ->whereYear('created_at', $this->request->year ?? now()->year);
        }

        if ($this->request->filled('user_id')) {
            $query->where('user_id', $this->request->user_id);
        }

        return view('absensi.export_excel', [
            'absensis' => $query->get(),
        ]);
    }
}
