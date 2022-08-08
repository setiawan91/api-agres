<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();
        return response()->json([
            'status' => 'success',
            'data' => $produk,
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
            'nama' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'deskripsi' => 'required',
            'variasi' => 'required',
        ]);

        $produk = Produk::create([
            'nama' => $request->nama,
            'sku' => $request->sku,
            'brand' => $request->brand,
            'deskripsi' => $request->deskripsi,
            'variasi' => $request->variasi,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambah',
            'data' => $produk,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus',
            'data' => $produk,
        ]);
    }
}
