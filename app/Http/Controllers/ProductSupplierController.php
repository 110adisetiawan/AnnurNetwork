<?php

namespace App\Http\Controllers;

use App\Models\Product_Supplier;
use Illuminate\Http\Request;

class ProductSupplierController extends Controller
{
    public function index()
    {
        $suppliers = Product_Supplier::all();
        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:suppliers',
            'contact_info' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        Product_Supplier::create($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Product_Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Product_Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|unique:suppliers,name,' . $supplier->id,
            'contact_info' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $supplier->update($request->all());
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Product_Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
