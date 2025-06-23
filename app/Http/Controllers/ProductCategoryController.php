<?php

namespace App\Http\Controllers;

use App\Models\Product_Category;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = Product_Category::latest()->paginate(5);
        return view('product.category.index', compact('categories'));
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_categories'
        ], [
            'name.required' => 'Insert data gagal, Nama kategori harus diisi.',
            'name.unique' => 'Insert data gagal, Nama kategori [' . $request->name . '] sudah ada.'
        ]);

        Product_Category::create($request->all());
        return redirect()->route('product_categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Product_Category $category) {}

    public function update(Request $request, Product_Category $category)
    {
        $request->validate([
            'name' => 'required|unique:product_categories,name,' . $category->id
        ]);

        $update = Product_Category::find($request->id);
        $update->name = $request->name;
        $result = $update->save();
        return redirect()->route('product_categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request)
    {
        $delete = Product_Category::find($request->id);
        $delete->delete();
        return redirect()->route('product_categories.index')->with('success', 'Kategori [' . $request->name . '] berhasil dihapus.');
    }
}
