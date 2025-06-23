<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product_StockMovement;

class ProductStockMovementController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function index()
    {
        $product_movements = Product_StockMovement::with(['product', 'user', 'supplier'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $product = Product::all();

        return view('product.stock_movement.index', compact('product_movements', 'product'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required',
            'movement_type' => 'required|in:masuk,keluar',
            'quantity' => 'required|integer',
            'damage_status' => 'required|in:none,damaged',
            'damage_reason' => 'nullable|string',
            'transaction_date' => 'required|date',

        ]);

        $data['user_id'] = Auth::user()->id; // ambil ID user aktif
        Product_StockMovement::create($data);

        $product = Product::find($data['product_id']);
        if ($data['movement_type'] === 'masuk') {
            $product->stock += $data['quantity'];
        } elseif ($data['movement_type'] === 'keluar') {
            if ($product->stock < $data['quantity']) {
                return redirect()->back()->withErrors(['quantity' => 'Stok tidak mencukupi!']);
            }
            $product->stock -= $data['quantity'];
        }
        $product->save();



        return redirect()->route('product_stock_movements.index')->with('success', 'Data keluar masuk barang berhasil ditambahkan.');
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
    public function destroy($id)
    {
        $movement = Product_StockMovement::findOrFail($id);
        $movement->delete();
        return redirect()->route('product_stock_movements.index')->with('success', 'transaksi barang berhasil dihapus.');
    }
}
