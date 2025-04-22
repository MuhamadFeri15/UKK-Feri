<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */




     public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'harga' => 'required|numeric',
        'stock' => 'required|numeric',
    ]);

    // Store the image in the public/storage directory
    $gambar = $request->file('gambar_produk');
    $gambarPath = $gambar->store('produk_images', 'public'); // This saves the image in storage/app/public/produk_images

    Produk::create([
        'nama_produk' => $request->nama_produk,
        'gambar_produk' => $gambarPath,  // Store the path to the image in the database
        'harga' => $request->harga,
        'stock' => $request->stock,
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $produk = Produk::findOrFail($id); // Fetch produk by ID
        if (!$produk) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan.');
        }
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'harga' => 'required|numeric',
        'stock' => 'required|numeric',
    ]);

    // Cek apakah ada file gambar baru
    if ($request->hasFile('gambar_produk')) {
        // Simpan gambar di storage Laravel dan dapatkan path-nya
        $gambarPath = $request->file('gambar_produk')->store('produk', 'public');

        // Hapus gambar lama jika ada
        if ($produk->gambar_produk) {
            Storage::disk('public')->delete($produk->gambar_produk);
        }

        $produk->gambar_produk = $gambarPath;
    }

    // Update data produk
    $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'stock' => $request->stock,
    ]);

    return redirect()->route('produk.index')->with('successUpdate', 'Produk berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk, $id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');

    }
}
