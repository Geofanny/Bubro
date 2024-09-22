<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
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

    public function viewIndex()
    {
        $products = Product::get();
        return view('dashboard-admin/product/product',['products' => $products]);
    }
    public function viewInsert()
    {
        $category =  Category::first()->get();
        return view('dashboard-admin/product/insert-product',['categories' => $category]);
    }
    public function insert(Request $request)
    {

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // $fileName = null;
        // if ($request->hasFile('image')) {
        //     // generate random string untuk nama file
        //     $fileName = $this->generateRandomString();
        //     // ambil extension file
        //     $extension = $request->file('image')->extension();

        //     // Simpan file gambar ke storage
        //     Storage::putFileAs('product-image', $request->file('image'), $fileName . '.' . $extension);
        // }

        $fileName = null;
        if ($request->hasFile('image')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();
        // ambil extension file
            $extension = $request->file('image')->extension();

        // Path tujuan di folder public
            $path = public_path('product-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

         // Simpan file gambar ke folder public/product-image
            $request->file('image')->move($path, $fileName . '.' . $extension);
        }


        // Simpan data produk ke database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category,
            'image' => $fileName ? $fileName . '.' . $extension : null,
            'stock' => $request->stock
        ]);

        return redirect('/product-admin');
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'stock' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category');
        $product->stock = $request->input('stock');

        $fileName = null;
        if ($request->hasFile('image')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();

        // ambil extension file
            $extension = $request->file('image')->extension();

        // Path tujuan di folder public
            $path = public_path('product-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

        // Simpan file gambar ke folder public/product-image
            $request->file('image')->move($path, $fileName . '.' . $extension);

        // Set nama file yang baru ke dalam database
            $product->image = $fileName . '.' . $extension;
        }

        $product->save();
        return redirect('/product-admin');
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            $imagePath = public_path('product-image/' . $product->image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();
        return redirect('/product-admin')->with('success', 'Product deleted successfully!');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category =  Category::first()->get();
        return view('dashboard-admin/product/edit-product',[
            'product' => $product,
            'categories' => $category
        ]);
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
