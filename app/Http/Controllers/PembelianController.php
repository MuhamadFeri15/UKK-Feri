<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
        public function index(Request $request)
    {
        $query = Pembelian::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_pelanggan', 'like', "%{$search}%")
                  ->orWhere('tanggal_penjualan', 'like', "%{$search}%")
                  ->orWhere('total_harga', 'like', "%{$search}%")
                  ->orWhere('dibuat_oleh', 'like', "%{$search}%");
            });
        }
    
        if ($request->filled('tanggal')) {
            $query->whereDay('tanggal_penjualan', $request->tanggal);
        }
    
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_penjualan', $request->bulan);
        }
    
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_penjualan', $request->tahun);
        }
    
        $pembelian = $query->get();
        $tahunList = Pembelian::selectRaw('YEAR(tanggal_penjualan) as tahun')->distinct()->pluck('tahun');
    
        return view('pembelian.index', compact('pembelian', 'tahunList'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembelian $pembelian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembelian $pembelian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembelian $pembelian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {
        //
    }
}
