<?php

namespace App\Exports;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Product_StockMovement;
use Maatwebsite\Excel\Concerns\FromView;


class ProductReportExport implements FromView
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $query = Product_StockMovement::with('product')->orderBy('transaction_date', 'desc');

        if ($this->request->filter === 'date' && $this->request->filled('from_date') && $this->request->filled('to_date')) {
            $query->whereBetween('transaction_date', [$this->request->from_date, $this->request->to_date]);
        } elseif ($this->request->filter === 'month') {
            $query->whereMonth('transaction_date', $this->request->month ?? now()->month)
                ->whereYear('transaction_date', $this->request->year ?? now()->year);
        }

        if ($this->request->filled('product_id')) {
            $query->where('product_id', $this->request->product_id);
        }

        return view('product.report.export_excel', [
            'reports' => $query->get(),
        ]);
    }
}
