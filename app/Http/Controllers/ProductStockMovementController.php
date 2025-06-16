<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Product_StockMovement;

class ProductStockMovementController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $product_movements = Product_StockMovement::with(['product', 'user', 'supplier'])->get();
        return view('stock_movements.index', compact('product_movements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock_movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'movement_type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer',
            'damage_status' => 'required|in:none,damaged',
            'damage_reason' => 'nullable|string',
        ]);

        Product_StockMovement::create($request->all());

        return redirect()->route('stock_movements.index')->with('success', 'Data keluar masuk barang berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product_StockMovement $product_StockMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product_StockMovement $product_StockMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product_StockMovement $product_StockMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product_StockMovement $product_StockMovement)
    {
        //
    }
}
