<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index');
    }

    // Endpoint JSON untuk daftar produk
    public function listJson(Request $request)
    {
        // contoh: ambil semua produk, bisa dijadikan paginasi / filter
        $products = ProductModel::orderBy('created_at','desc')->get();
        // Select * from product order by created_at desc;

        return response()->json([
            'data' => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price')
        ];

        // insert ke tabel
        ProductModel::create($data); //dalam create harus array

        return redirect()->route('products.index')->with('success', 'Produk berhasil dibuat.');
    }

    public function show(ProductModel $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(ProductModel $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);

        $data = ProductModel::find($id)->update($request->all());
    }

    public function destroy(ProductModel $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
