<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'), [
            'title' => 'Produk',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create', [
            'title' => 'Produk',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
        ]);
        $produk = new Produk;
        $produk->nama = $request->nama;
        $produk->keterangan = $request->keterangan;
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->move(public_path('img/produk'), $nama_file);
            $produk->gambar = $nama_file;
        }
        $produk->harga = $request->harga;
        $produk->save();
        return redirect()->route('admin.produk')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $produk = Produk::find($request->id);
        return view('produk.edit', compact('produk'), [
            'title' => 'Produk',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required',
        ]);
        $produk = Produk::find($request->id);
        $produk->nama = $request->nama;
        $produk->keterangan = $request->keterangan;
        if ($request->file('gambar')) {
            $file = $request->file('gambar');
            $nama_file = time() . '.' . $file->getClientOriginalExtension();
            $file = $file->move(public_path('img/produk'), $nama_file);
            $produk->gambar = $nama_file;
        }
        $produk->harga = $request->harga;
        $produk->save();
        return redirect()->route('admin.produk')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $produk = Produk::find($request->id);
        $produk->delete();
        return redirect()->route('admin.produk')->with('success', 'Data berhasil dihapus');
    }
}
