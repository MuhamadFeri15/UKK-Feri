<?php
namespace App\Exports;

use App\Models\Pembelian;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PembeliansExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pembelian::select([
            'nama_pelanggan',
            'no_hp_pelanggan',
            'poin_pelanggan',
            'deskripsi_produk',
            'total_harga',
            'total_bayar',
            'total_diskon',
            'poin_total',
            'kembalian',
            'tanggal_penjualan',
            'dibuat_oleh'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'No HP Pelanggan',
            'Poin Pelanggan',
            'Deskripsi Produk',
            'Total Harga',
            'Total Bayar',
            'Total Diskon',
            'Poin Total',
            'Kembalian',
            'Tanggal Penjualan',
            'Dibuat Oleh'
        ];
    }
}
