<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Product_Report;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ProductReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product_StockMovement;

class ProductReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware(['role:Administrator|Karyawan'])->only(['index', 'edit']);
        $this->middleware(['role:Administrator'])->only(['create', 'store', 'update', 'destroy']);
    }

    public function exportPdf(Request $request)
    {
        $reports = $this->getFilteredReports($request);
        $pdf = Pdf::loadView('product.report.export_pdf', compact('reports'));
        return $pdf->download('laporan_transaksi_barang_' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filename = 'laporan_transaksi_barang_' . now()->format('Y-m-d') . '.xlsx';
        return Excel::download(new ProductReportExport($request), $filename);
    }

    private function getFilteredReports(Request $request)
    {
        $query = \App\Models\Product_StockMovement::with('product')->orderBy('transaction_date', 'desc');

        if ($request->filter === 'date' && $request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('transaction_date', [$request->from_date, $request->to_date]);
        } elseif ($request->filter === 'month') {
            $month = $request->get('month', now()->month);
            $year  = $request->get('year', now()->year);

            $query->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year);
        }

        if ($request->filled('product_id')) {
            $query->where('product_id', $request->product_id);
        }

        return $query->get();
    }


    public function index(Request $request)
    {
        $filterMode = $request->get('filter');
        $query = Product_StockMovement::with('product')->orderBy('transaction_date', 'desc');

        if ($filterMode === 'date') {
            if ($request->filled('from_date') && $request->filled('to_date')) {
                $query->whereBetween('transaction_date', [$request->from_date, $request->to_date]);
            }
            if ($request->filled('product_id')) {
                $query->where('product_id', $request->product_id);
            }
        } elseif ($filterMode === 'month') {
            $month = $request->get('month', now()->month);
            $year = $request->get('year', now()->year);

            $query->whereMonth('transaction_date', $month)
                ->whereYear('transaction_date', $year);

            if ($request->filled('product_id')) {
                $query->where('product_id', $request->product_id);
            }
        }

        $products = Product::all();
        $reports = $query->get();

        return view('product.report.index', compact('reports', 'products'));
    }

    public function create()
    {
        $movements = Product_StockMovement::all();
        return view('reports.create', compact('movements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'stock_movement_id' => 'required',
            'report_date' => 'required|date',
            'details' => 'nullable|string',
        ]);

        Product_Report::create($request->all());

        return redirect()->route('reports.index')->with('success', 'Laporan transaksi berhasil dibuat.');
    }


    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(Product_Report $product_Report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product_Report $product_Report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product_Report $product_Report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product_Report $product_Report)
    {
        //
    }
}
