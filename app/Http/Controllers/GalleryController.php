<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Resources\galleryResource;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Gallery::paginate(10);
        return view('dashboard-admin/gallery/gallery',['galleries' => $gallery]);
    }

    public function getAll()
    {
        $gallery = Gallery::get();
        if ($gallery->isEmpty()) {
            return response()->json(['message' => 'No gallery found.'], 404);
        }

        return galleryResource::collection($gallery);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard-admin/gallery/insert-gallery');
    }

    public function insert(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required',
            'media_path' => 'required|file'
        ]);

        $namaFile = null;

        if ($request->hasFile('media_path')) {
            $namaFile = $this->generateRandomString();
            $ekstensi = $request->file('media_path')->extension();
            $path = public_path('gambar-galeri');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $request->file('media_path')->move($path, $namaFile . '.' . $ekstensi);
        }

        $galeri = Gallery::create([
            'title' => $request->title,
            'media_path' => $namaFile ? $namaFile . '.' . $ekstensi : null,
        ]);

        return new galleryResource($galeri);
    }

    public function updateGallery(Request $request,$id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'media_path' => 'nullable|file'
        ]);

        $gallery = Gallery::find($id);

        if ($request->hasFile('media_path')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();

        // ambil extension file
            $extension = $request->file('media_path')->extension();

        // Path tujuan di folder public
            $path = public_path('gallery-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

        // Simpan file gambar ke folder public/product-image
            $request->file('media_path')->move($path, $fileName . '.' . $extension);

        // Set nama file yang baru ke dalam database
            $gallery->media_path = $fileName . '.' . $extension;
        }

        $gallery->update($request->all());
        
        return new galleryResource($gallery);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'media_path' => 'required'
        ]);

        $fileName = null;
        if ($request->hasFile('media_path')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();
        // ambil extension file
            $extension = $request->file('media_path')->extension();

        // Path tujuan di folder public
            $path = public_path('gallery-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

         // Simpan file gambar ke folder public/product-image
            $request->file('media_path')->move($path, $fileName . '.' . $extension);
        }

        Gallery::create([
            'title' => $request->title,
            'media_path' => $fileName ? $fileName . '.' . $extension : null,
        ]);

        return redirect('/gallery-admin');
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
    public function show($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json(['message' => 'gallery not found.'], 404);
        }

        return new galleryResource($gallery);
    }

    public function delete($id)
    {
        $gallery = Gallery::find($id);
        if (!$gallery) {
            return response()->json(['message' => 'gallery not found.'], 404);
        }

        $gallery->delete();

        return new galleryResource($gallery);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('dashboard-admin/gallery/edit-gallery',['gallery' => $gallery]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'media_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gallery = Gallery::findOrFail($id);
        $gallery->title = $request->input('title');
        $fileName = null;
        if ($request->hasFile('media_path')) {
        // generate random string untuk nama file
            $fileName = $this->generateRandomString();

        // ambil extension file
            $extension = $request->file('media_path')->extension();

        // Path tujuan di folder public
            $path = public_path('gallery-image');

        // Pastikan folder ada, jika tidak, buat foldernya
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

        // Simpan file gambar ke folder public/product-image
            $request->file('media_path')->move($path, $fileName . '.' . $extension);

        // Set nama file yang baru ke dalam database
            $gallery->media_path = $fileName . '.' . $extension;
        }

        $gallery->save();
        return redirect('/gallery-admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->media_path) {
            $imagePath = public_path('gallery-image/' . $gallery->media_path);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $gallery->delete();
        return redirect('/gallery-admin')->with('success', 'Image deleted successfully!');
    }
}
