<?php

namespace App\Http\Controllers;

use App\Models\Product_Supplier;
use Illuminate\Http\Request;

class ProductSupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator|Karyawan'])->only(['index', 'edit']);
        $this->middleware(['role:Administrator'])->only(['create', 'store', 'update', 'destroy']);
    }

    public function index()
    {
        $suppliers = Product_Supplier::latest()->paginate(5);
        return view('product.supplier.index', compact('suppliers'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_suppliers',
            'contact_info' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        Product_Supplier::create($request->all());
        return redirect()->route('product_suppliers.index')->with('success', 'Supplier [' . $request->name . '] berhasil ditambahkan.');
    }

    public function edit(Product_Supplier $supplier) {}

    public function update(Request $request, Product_Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|unique:product_suppliers,name,' . $supplier->id,
            'contact_info' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $update = Product_Supplier::find($request->id);
        $update->name = $request->name;
        $update->contact_info = $request->contact_info;
        $update->address = $request->address;
        $result = $update->save();
        return redirect()->route('product_suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $delete = Product_Supplier::find($request->id);
        $delete->delete();
        return redirect()->route('product_suppliers.index')->with('success', 'Supplier [' . $request->name . '] berhasil dihapus.');
    }
}
