<?php

namespace App\Http\Controllers;

use App\Models\Product_Report;
use App\Models\Product_StockMovement;
use Illuminate\Http\Request;

class ProductReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = Product_Report::with(['product', 'user', 'stockMovement'])->get();
        return view('reports.index', compact('reports'));
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
