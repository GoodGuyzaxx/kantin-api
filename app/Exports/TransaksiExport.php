<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $nama;
    protected $month;

    public function __construct($nama, $month = null)
    {
        $this->nama = $nama;
        $this->month = $month;
    }

    public function query()
    {
        $query = Transaksi::query()
            ->where('nama_konsumen', $this->nama)
            ->join('kantins', 'kantins.id_kantin', '=', 'transaksis.id_kantin');

        if ($this->month) {
            $query->whereMonth('transaksis.created_at', $this->month);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID Order',
            'Nama Kantin',
            'Harga',
            'Menu',
            'Jumlah',
            'Status Pesanan',
            'Jenis Pembayaran',
            'Status Pembayaran',
            'Tanggal Order',
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->id_order,
            $transaksi->nama_kantin,
            $transaksi->total_harga,
            $transaksi->menu,
            $transaksi->jumlah,
            $transaksi->status_pesanan,
            $transaksi->tipe_pembayaran,
            $transaksi->status_pembayaran,
            $transaksi->created_at,
        ];
    }
}
