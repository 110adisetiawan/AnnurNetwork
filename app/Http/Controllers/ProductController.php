<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_Category;
use App\Models\Product_Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:Administrator']);
    }

    public function index()
    {
        $category = Product_Category::all();
        $supplier = Product_Supplier::all();
        $products = Product::with(['product_category', 'product_supplier'])->get();
        return view('product.index', compact('products', 'category', 'supplier'));
    }

    public function create()
    {
        $category = Product_Category::all();
        $supplier = Product_Supplier::all();
        return view('product.create', compact('category', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'sku' => 'required|unique:products',
            'product_category_id' => 'required',
            'product_supplier_id' => 'required',
            'stock' => 'required|integer',
            'price' => 'required|numeric',
            'condition' => 'required',
            'damage_description' => 'required_if:condition,damaged',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $category = Product_Category::all();
        $supplier = Product_Supplier::all();
        return view('product.edit', compact('product', 'category', 'supplier'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
