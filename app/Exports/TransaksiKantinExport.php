<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\Kantin;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\Log;

class TransaksiKantinExport implements FromQuery, WithHeadings, WithMapping, WithEvents
{
    use Exportable;

    protected $kantinIdentifier;
    protected $month;
    protected $totalCompleted;

    public function __construct($kantinIdentifier, $month = null)
    {
        $this->kantinIdentifier = $kantinIdentifier;
        $this->month = $month;
    }

    public function query()
    {
        $query = Transaksi::query()
            ->join('kantins', 'kantins.id_kantin', '=', 'transaksis.id_kantin');

        if (is_numeric($this->kantinIdentifier)) {
            $query->where('transaksis.id_kantin', $this->kantinIdentifier);
        } else {
            $query->where('kantins.nama_kantin', $this->kantinIdentifier);
        }

        if ($this->month) {
            $query->whereMonth('transaksis.created_at', $this->month);
        }

        // Calculate total income
//        $this->totalIncome = $query->sum('total_harga');

        $id = $this->kantinIdentifier;
        $thisMonth = $this->month;

        $totalCompletedQuery = DB::table('transaksis')
            ->select(DB::raw('SUM(CASE WHEN row_num = 1 THEN total_harga ELSE 0 END) AS total_harga_completed'))
            ->fromSub(function ($query) use ($id, $thisMonth) {
                $query->select('id_order', 'total_harga')
                    ->selectRaw('ROW_NUMBER() OVER (PARTITION BY id_order ORDER BY created_at) AS row_num')
                    ->from('transaksis')
                    ->where('id_kantin', $id)
                    ->where('status_pesanan', 'Selesai');

                if ($thisMonth) {
                    $query->whereMonth('created_at', $this->month);
                }
            }, 'subquery');

        $this->totalCompleted = $totalCompletedQuery->value('total_harga_completed') ?? 0;

//        Log::info('Export Query', [
//            'sql' => $query->toSql(),
//            'bindings' => $query->getBindings(),
//            'kantinIdentifier' => $this->kantinIdentifier,
//            'month' => $this->month,
//            'totalIncome' => $this->totalCompleted
//        ]);

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID Order',
            'Nama Pemesan',
            'Email Konsumen',
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
            $transaksi->id,
            $transaksi->id_order,
            $transaksi->nama_konsumen,
            $transaksi->email_konsumen,
            $transaksi->total_harga,
            $transaksi->menu,
            $transaksi->jumlah,
            $transaksi->status_pesanan,
            $transaksi->tipe_pembayaran,
            $transaksi->status_pembayaran,
            $transaksi->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet;
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn();

                // Add title
                $sheet->mergeCells('A1:' . $lastColumn . '1');
                $sheet->setCellValue('A1', 'Laporan Transaksi Kantin: ' . $this->kantinIdentifier .
                    ($this->month ? ' - ' . date('F Y', mktime(0, 0, 0, $this->month, 1)) : ''));
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // Move actual data down by 1
                $sheet->insertNewRowBefore(2);

                // Add total income row
                $totalRowIndex = $lastRow + 2;
                $sheet->setCellValue('A' . $totalRowIndex, 'Total Pendapatan:');
                $sheet->setCellValue('B' . $totalRowIndex, $this->totalCompleted);
                $sheet->getStyle('A' . $totalRowIndex . ':B' . $totalRowIndex)->getFont()->setBold(true);
                $sheet->getStyle('B' . $totalRowIndex)->getNumberFormat()->setFormatCode('#,##0');

                // Style the header row
                $headerRowIndex = 2;
                $sheet->setCellValue('A' . $headerRowIndex, 'No');
                $sheet->setCellValue('B' . $headerRowIndex, 'ID Order');
                $sheet->setCellValue('C' . $headerRowIndex, 'Nama Pemesan');
                $sheet->setCellValue('D' . $headerRowIndex, 'Email Konsumen');
                $sheet->setCellValue('E' . $headerRowIndex, 'Total Harga');
                $sheet->setCellValue('F' . $headerRowIndex, 'Menu');
                $sheet->setCellValue('G' . $headerRowIndex, 'Jumlah');
                $sheet->setCellValue('H' . $headerRowIndex, 'Status Pesanan');
                $sheet->setCellValue('I' . $headerRowIndex, 'Jenis Pembayaran');
                $sheet->setCellValue('J' . $headerRowIndex, 'Status Pembayaran');
                $sheet->setCellValue('K' . $headerRowIndex, 'Tanggal Order');
                $sheet->getStyle('A' . $headerRowIndex . ':' . $lastColumn . $headerRowIndex)->applyFromArray([
                    'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => 'E0E0E0']],
                ]);

                // Apply border to all cells
                $sheet->getStyle('A' . $headerRowIndex . ':' . $lastColumn . ($lastRow + 1))->applyFromArray([
                    'borders' => [
                        'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
                    ],
                ]);
            },
        ];
    }
}
