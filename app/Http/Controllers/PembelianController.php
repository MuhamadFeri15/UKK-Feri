<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Exports\PembeliansExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Produk;
use App\Models\Member;
use App\Models\User;


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
        $produk = Produk::all();
        return view('pembelian.create', compact('produk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $dataProduk = $request->input('produk');
            $totalHarga = $request->input('total_harga');
            $jumlahBayar = $request->input('jumlah_bayar');
            $statusPelanggan = $request->input('status_pelanggan');

            if ($jumlahBayar < $totalHarga) {
                return back()->with('error', 'Jumlah bayar kurang')->with('goto_step2', true);
            }

            $memberId = null;
            $potonganPoin = 0;
            $poinBaru = 0;

            if ($statusPelanggan === 'member') {
                $member = Member::where('no_telp', $request->no_telp)->first();

                if (!$member) {
                    $member = Member::create([
                        'nama' => $request->nama_member ?? 'Member Baru',
                        'no_telp' => $request->no_telp,
                        'poin' => 0,
                    ]);
                }

                $memberId = $member->id;
                $gunakanPoin = $request->has('gunakan_poin');

                if ($gunakanPoin && $member->poin > 0) {
                    $poinYangDipakai = min($member->poin, floor($totalHarga / 100));
                    $potonganPoin = $poinYangDipakai * 100;
                    $totalHarga -= $potonganPoin;
                    $member->poin -= $poinYangDipakai;
                }

                $poinBaru = floor($totalHarga / 10000);
                $member->poin += $poinBaru;
                $member->save();
            }

            $pembelian = Pembelian::create([
                'member_id' => $memberId,
                'status_pelanggan' => $statusPelanggan,
                'no_hp_pelanggan' => $request->no_telp,
                'poin_pelanggan' => $potonganPoin,
                'deskripsi_produk' => $request->deskripsi_pembayaran,
                'nama_pelanggan' => $request->nama_member,
                'total_harga' => $totalHarga,
                'total_bayar' => $jumlahBayar,
                'total_diskon' => $potonganPoin,
                'kembalian' => $jumlahBayar - $totalHarga,
                'poin_total' => $poinBaru,
                'deskripsi_pembayaran' => $request->deskripsi_pembayaran,
                'dibuat_oleh' => Auth::user()->name,
            ]);

            foreach ($dataProduk as $id => $item) {
                $qty = intval($item['qty']);
                if ($qty <= 0) continue;

                $produk = Produk::find($id);
                if (!$produk) {
                    throw new \Exception("Produk tidak ditemukan.");
                }

                if ($produk->stock < $qty) {
                    throw new \Exception("Stok produk '{$produk->nama_produk}' tidak mencukupi.");
                }

                $pembelian->detailPembelians()->create([
                    'produk_id' => $id,
                    'nama_produk' => $produk->nama_produk,
                    'harga' => $produk->harga,
                    'qty' => $qty,
                    'sub_total' => $produk->harga * $qty,
                ]);

                $produk->stock -= $qty;
                $produk->save();
            }

            DB::commit();
            return redirect()->route('pembelian.invoice', $pembelian->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal simpan: ' . $e->getMessage())->with('goto_step2', true);
        }
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembelian $pembelian)
    {

    }

    public function exportPembelians()
{
    return Excel::download(new PembeliansExport, 'pembelians.xlsx');
}

}
