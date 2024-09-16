<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();

        // Untuk Web
        // return view('dashboard-admin/index');

        // Tipe 1
        // return response()->json(['data' => $products]);

        // mirip dengan Tipe 1 tapi menggunakan resource dan harus di instal dulu packpage nya 
        return ProductResource::collection($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
            'file_img' => 'required',
        ]);

        // Jika file gambar ada
        if ($request->hasFile('file_img')) {
            // generate random string untuk nama file
            $fileName = $this->generateRandomString();
            // ambil extension file
            $extension = $request->file('file_img')->extension();

            // Simpan file gambar ke storage
            Storage::putFileAs('product-image', $request->file('file_img'), $fileName . '.' . $extension);

            // Tambahkan nama file yang baru ke dalam array validasi
            $validated['image'] = $fileName . '.' . $extension;
        }


        $product = Product::create($validated);

        return new ProductResource($product); 
        // return response()->json('dd');
    }

    function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::findOrFail($product->id);
        
        // Tipe 1 
        // return response()->json(['data' => $product]);

        // Resource jika get By ID
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return new ProductResource($product);
    }
}
