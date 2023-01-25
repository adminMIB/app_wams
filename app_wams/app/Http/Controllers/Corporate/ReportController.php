<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Models\CreatePRK;
use App\Models\CreateProject;
use App\Models\OpptyProject;
use App\Models\PicDistributor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends Controller
{
    public $abjad = [
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'
    ];

    public $th_start_at = 4;

    public $th_pembayaran = [
        'id_project',
        'project_name',
        'client_name',
        'principal_name',
        'bmt',
        'services',
        'lain',
        'subtotal',
        'bunga_admin',
        'biaya_admin',
        'biaya_pengurangan',
        'total_final',
        'created_at'
    ];

    public $dcl = [
        'nama_disti',
        'pic_disti',
        'jabatan_pic',
        'email_pic',
        'nomor_hp',
        'pengajuan_cl',
        'jumlah_cl'
    ];

    public $cmm = [
        'pengajuan_cl',
        'jumlah_cl',
        'jenis_kolateral',
        'keterangan'
    ];

    public function AcdcReport(Request $request)
    {
        $data = CreateProject::with(['detail'])->whereBetween('created_at', [
            Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
            Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
        ]);

        if (!empty($request->client)) {
            $data = $data->where('client', $request->client);
        }

        if (!empty($request->principal)) {
            $data = $data->where('principal', $request->principal);
        }

        $data = $data->get();

        $nama_table = "Project ACDC";
        $total_pendapatan = [
            'index' => 'Total Nominal Project ACDC',
            'data' => 'Rp' . number_format($data->sum('jumlah_cl')),
            'th' => 'A2', 'td' => 'B2'
        ];

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getSecurity()->setLockWindows(true);
        $spreadsheet->getSecurity()->setLockStructure(true);
        $spreadsheet->getSecurity()->setWorkbookPassword("123");

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue(
            'A1', 'Export Laporan Data ' . ucfirst($nama_table) . 
            ' Periode ' .  date('d/M/y', 
            strtotime($request->start_date)) . ' - ' . date('d/M/y', strtotime($request->end_date))
        );

        $sheet->setCellValue($total_pendapatan['th'], $total_pendapatan['index']);
        $sheet->setCellValue($total_pendapatan['td'], $total_pendapatan['data']);
        $sheet->getStyle($total_pendapatan['td'])->getAlignment()->setHorizontal('center');
        $data_th_for_looping = $this->th_pembayaran;

        foreach ($data_th_for_looping as $key => $data_th) {
            #initialize variable for th
            $th = implode(' ', explode('_', ucfirst($data_th)));
            $abjad = $this->abjad[$key];
            $th_start_at =  $this->th_start_at;
            $sheet->setCellValue($abjad . $th_start_at, $th);
            $sum = $this->th_start_at;

            #insert data for td
            foreach ($data as $dataKey => $data_table) {
                $sum += 1;
                if ($data_th == 'terbayar') {
                    $sheet->setCellValue($this->abjad[$key] . $sum, date('d-m-Y', strtotime($data_table->$data_th)));
                } else {
                    $sheet->setCellValue($this->abjad[$key] . $sum, $data_table->$data_th);
                }
            }
        }

        $get_abjad_terakhir = $abjad;
        $styling_full_widht = "A1:$get_abjad_terakhir" . "1";
        #Header Style
        $spreadsheet->getActiveSheet()->mergeCells($styling_full_widht);
        $sheet->getStyle($styling_full_widht)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A1")->getFont()->setSize(15);
        #th Style
        $sheet->getStyle('A' . $th_start_at . ':' . $get_abjad_terakhir . $th_start_at)->getAlignment()->setHorizontal('center');
        #all style
        $spreadsheet->getActiveSheet()->getDefaultColumnDimension('A')->setWidth(25);

         // =========================================================================

        #new sheet
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Transaction Maker ACDC ');
        $produk_terjual = $spreadsheet->addSheet($myWorkSheet, 0);
        $produk_terjual->setCellValue(
            'A1', 'Export Laporan Transaction Maker ACDC Periode ' .  
            date('d/M/y', strtotime($request->start_date)) . ' - ' . 
            date('d/M/y', strtotime($request->end_date)
        ));

        $start_from = 2;
        $produk_terjual->setCellValue('A' . $start_from, 'Project Name')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('B' . $start_from, 'ID Project')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('C' . $start_from, 'Jenis Transaksi')->getColumnDimension('B')->setWidth(20);
        $produk_terjual->setCellValue('D' . $start_from, 'Nama Tujuan')->getColumnDimension('C')->setWidth(20);
        $produk_terjual->setCellValue('E' . $start_from, 'Nominal')->getColumnDimension('D')->setWidth(20);
        $produk_terjual->setCellValue('F' . $start_from, 'Keterangan')->getColumnDimension('E')->setWidth(20);
        $produk_terjual->setCellValue('G' . $start_from, 'Tanggal Pengajuan')->getColumnDimension('E')->setWidth(20);

        $sum = $start_from;
        foreach ($data as $dataKey => $data_table) {
            $sum += 1;
            $produk_terjual->setCellValue("A$sum", $data_table->project_name);
            $produk_terjual->setCellValue("B$sum", $data_table->id_project ?? 'data telah di hapus');
            foreach ($data_table->detail as $item) {
                $produk_terjual->setCellValue("C$sum", $item->jenis_transaksi ?? 'data telah di hapus');
                $produk_terjual->setCellValue("D$sum", $item->nama_tujuan ?? 'data telah di hapus');
                $produk_terjual->setCellValue("E$sum", $item->nominal ?? 'data telah di hapus');
                $produk_terjual->setCellValue("F$sum", $item->keterangan ?? 'data telah di hapus');
                $produk_terjual->setCellValue("G$sum", $item->tanggal ?? 'data telah di hapus');
            }
        }
        #styling of trans maker sheet
        $produk_penjualan_header = 'A1:H1';
        $produk_penjualan_th = "A$start_from:H$start_from";
        $produk_terjual->mergeCells($produk_penjualan_header);
        $produk_terjual->getStyle($produk_penjualan_header)->getAlignment()->setHorizontal('center');
        $produk_terjual->getStyle("A1")->getFont()->setSize(15);
        $produk_terjual->getStyle($produk_penjualan_th)->getAlignment()->setHorizontal('center');

        // =============================================================================================
        $writer = new Xlsx($spreadsheet);
        $link = "/export/excel/laporan-project_acdc.xlsx";
        
        $writer->save('export/excel/laporan-project_acdc.xlsx');

        $headers = [
            'Content-Type' => 'application/xlsx',
        ];

        return response()->json([
            "status" => "success",
            "link" => $link
        ]);
    }

    public function ReimbursementReport(Request $request)
    {
        $data = DB::table('transaction_maker_reimbursements')->select(
                'transaction_maker_reimbursements.*',
                'oppty_projects.ID_opptyproject',
                'oppty_projects.nama_project',
                'oppty_projects.jenis',
                'oppty_projects.client'
            )
            ->leftJoin('oppty_projects', 'transaction_maker_reimbursements.opptyproject_id', '=', 'oppty_projects.id')
            ->whereBetween('transaction_maker_reimbursements.created_at', [
                Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
                Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
            ]);

        if (!empty($request->client)) {
            $data = $data->where('oppty_projects.client', $request->client);
        }

        if (!empty($request->jenis)) {
            $data = $data->where('oppty_projects.jenis', $request->jenis);
        }

        $data = $data->get();
        $nama_table = "Reimbursement";
        
        $total_pendapatan = [
            'index' => 'Total Nominal Reimbursement ACDC',
            'data' => 'Rp' . number_format($data->sum('nominal_reimbursement')),
            'th' => 'A2', 'td' => 'B2'
        ];


        $spreadsheet = new Spreadsheet();
        $spreadsheet->getSecurity()->setLockWindows(true);
        $spreadsheet->getSecurity()->setLockStructure(true);
        $spreadsheet->getSecurity()->setWorkbookPassword("123");

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue(
            'A1', 'Export Laporan Data ' . ucfirst($nama_table) . 
            ' Periode ' .  date('d/M/y', 
            strtotime($request->start_date)) . ' - ' . date('d/M/y', strtotime($request->end_date))
        );

        $sheet->setCellValue($total_pendapatan['th'], $total_pendapatan['index']);
        $sheet->setCellValue($total_pendapatan['td'], $total_pendapatan['data']);
        $sheet->getStyle($total_pendapatan['td'])->getAlignment()->setHorizontal('center');

        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Transaction Maker Reimbursment ');
        $produk_terjual = $spreadsheet->addSheet($myWorkSheet, 0);
        $produk_terjual->setCellValue(
            'A1', 'Export Laporan Transaction Maker Reimbursment Periode ' .  
            date('d/M/y', strtotime($request->start_date)) . ' - ' . 
            date('d/M/y', strtotime($request->end_date)
        ));

        $start_from = 2;
        $produk_terjual->setCellValue('A' . $start_from, 'ID Opptyproject')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('B' . $start_from, 'Project Name')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('C' . $start_from, 'Jenis')->getColumnDimension('B')->setWidth(20);
        $produk_terjual->setCellValue('D' . $start_from, 'PIC Reimbursement')->getColumnDimension('C')->setWidth(20);
        $produk_terjual->setCellValue('E' . $start_from, 'Nominal')->getColumnDimension('D')->setWidth(20);
        $produk_terjual->setCellValue('F' . $start_from, 'Client')->getColumnDimension('E')->setWidth(20);
        $produk_terjual->setCellValue('G' . $start_from, 'Tanggal Pengajuan')->getColumnDimension('E')->setWidth(20);

        $sum = $start_from;
        foreach ($data as $dataKey => $data_table) {
            $sum += 1;
            $produk_terjual->setCellValue("A$sum", $data_table->ID_opptyproject);
            $produk_terjual->setCellValue("B$sum", $data_table->nama_project ?? 'data telah di hapus');
            $produk_terjual->setCellValue("C$sum", $data_table->jenis ?? 'data telah di hapus');
            $produk_terjual->setCellValue("D$sum", $data_table->nama_pic_reimbursement ?? 'data telah di hapus');
            $produk_terjual->setCellValue("E$sum", $data_table->nominal_reimbursement ?? 'data telah di hapus');
            $produk_terjual->setCellValue("F$sum", $data_table->client ?? 'data telah di hapus');
            $produk_terjual->setCellValue("G$sum", $data_table->tanggal_reimbursement ?? 'data telah di hapus');
        }
        #styling of trans maker sheet
        $produk_penjualan_header = 'A1:H1';
        $produk_penjualan_th = "A$start_from:H$start_from";
        $produk_terjual->mergeCells($produk_penjualan_header);
        $produk_terjual->getStyle($produk_penjualan_header)->getAlignment()->setHorizontal('center');
        $produk_terjual->getStyle("A1")->getFont()->setSize(15);
        $produk_terjual->getStyle($produk_penjualan_th)->getAlignment()->setHorizontal('center');

        // =============================================================================================
        $writer = new Xlsx($spreadsheet);
        $link = "/export/excel/laporan-reimbursment.xlsx";
        
        $writer->save('export/excel/laporan-reimbursment.xlsx');

        $headers = [
            'Content-Type' => 'application/xlsx',
        ];

        return response()->json([
            "status" => "success",
            "link" => $link
        ]);
    }

    public function DclReport(Request $request)
    {
        $data = PicDistributor::with(['detailtmdcl'])->whereBetween('created_at', [
            Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
            Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
        ]);

        if (!empty($request->disti)) {
            $data = $data->where('nama_disti', $request->disti);
        }

        $data = $data->get();

        $nama_table = "DCL";
        $total_pendapatan = [
            'index' => 'Total Nominal DCL',
            'data' => 'Rp' . number_format($data->sum('jumlah_cl')),
            'th' => 'A2', 'td' => 'B2'
        ];

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getSecurity()->setLockWindows(true);
        $spreadsheet->getSecurity()->setLockStructure(true);
        $spreadsheet->getSecurity()->setWorkbookPassword("123");

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue(
            'A1', 'Export Laporan Data ' . ucfirst($nama_table) . 
            ' Periode ' .  date('d/M/y', 
            strtotime($request->start_date)) . ' - ' . date('d/M/y', strtotime($request->end_date))
        );

        $sheet->setCellValue($total_pendapatan['th'], $total_pendapatan['index']);
        $sheet->setCellValue($total_pendapatan['td'], $total_pendapatan['data']);
        $sheet->getStyle($total_pendapatan['td'])->getAlignment()->setHorizontal('center');
        $data_th_for_looping = $this->dcl;

        foreach ($data_th_for_looping as $key => $data_th) {
            #initialize variable for th
            $th = implode(' ', explode('_', ucfirst($data_th)));
            $abjad = $this->abjad[$key];
            $th_start_at =  $this->th_start_at;
            $sheet->setCellValue($abjad . $th_start_at, $th);
            $sum = $this->th_start_at;

            #insert data for td
            foreach ($data as $dataKey => $data_table) {
                $sum += 1;
                if ($data_th == 'terbayar') {
                    $sheet->setCellValue($this->abjad[$key] . $sum, date('d-m-Y', strtotime($data_table->$data_th)));
                } else {
                    $sheet->setCellValue($this->abjad[$key] . $sum, $data_table->$data_th);
                }
            }
        }

        $get_abjad_terakhir = $abjad;
        $styling_full_widht = "A1:$get_abjad_terakhir" . "1";
        #Header Style
        $spreadsheet->getActiveSheet()->mergeCells($styling_full_widht);
        $sheet->getStyle($styling_full_widht)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A1")->getFont()->setSize(15);
        #th Style
        $sheet->getStyle('A' . $th_start_at . ':' . $get_abjad_terakhir . $th_start_at)->getAlignment()->setHorizontal('center');
        #all style
        $spreadsheet->getActiveSheet()->getDefaultColumnDimension('A')->setWidth(25);

          // =========================================================================

        #new sheet
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Transaction Maker DCL ');
        $produk_terjual = $spreadsheet->addSheet($myWorkSheet, 0);
        $produk_terjual->setCellValue(
            'A1', 'Export Laporan Transaction Maker DCL Periode ' .  
            date('d/M/y', strtotime($request->start_date)) . ' - ' . 
            date('d/M/y', strtotime($request->end_date)
        ));

        $start_from = 2;
        $produk_terjual->setCellValue('A' . $start_from, 'Project Name')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('B' . $start_from, 'Client')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('C' . $start_from, 'Nominal PO')->getColumnDimension('B')->setWidth(20);
        $produk_terjual->setCellValue('D' . $start_from, 'Nama SBU')->getColumnDimension('C')->setWidth(20);
        $produk_terjual->setCellValue('E' . $start_from, 'Nama PIC')->getColumnDimension('D')->setWidth(20);
        $produk_terjual->setCellValue('F' . $start_from, 'Tanggal Pengajuan')->getColumnDimension('E')->setWidth(20);

        $sum = $start_from;
        foreach ($data as $dataKey => $data_table) {
            $sum += 1;
            foreach ($data_table->detailtmdcl as $item) {
                $produk_terjual->setCellValue("A$sum", $data_table->nama_project);
                $produk_terjual->setCellValue("B$sum", $data_table->nama_client ?? 'data telah di hapus');
                $produk_terjual->setCellValue("C$sum", $item->nominal_po ?? 'data telah di hapus');
                $produk_terjual->setCellValue("D$sum", $item->nama_sbu ?? 'data telah di hapus');
                $produk_terjual->setCellValue("E$sum", $item->nama_pic ?? 'data telah di hapus');
                $produk_terjual->setCellValue("F$sum", $item->tanggal_po ?? 'data telah di hapus');
            }
        }
        #styling of trans maker sheet
        $produk_penjualan_header = 'A1:F1';
        $produk_penjualan_th = "A$start_from:F$start_from";
        $produk_terjual->mergeCells($produk_penjualan_header);
        $produk_terjual->getStyle($produk_penjualan_header)->getAlignment()->setHorizontal('center');
        $produk_terjual->getStyle("A1")->getFont()->setSize(15);
        $produk_terjual->getStyle($produk_penjualan_th)->getAlignment()->setHorizontal('center');

        // =============================================================================================
        $writer = new Xlsx($spreadsheet);
        $link = "/export/excel/laporan-DCL.xlsx";
        
        $writer->save('export/excel/laporan-DCL.xlsx');

        $headers = [
            'Content-Type' => 'application/xlsx',
        ];

        return response()->json([
            "status" => "success",
            "link" => $link
        ]);
    }

    public function CmmReport(Request $request)
    {
        $data = CreatePRK::with(['tmcmm'])->whereBetween('created_at', [
            Carbon::parse($request->start_date)->format('Y-m-d') . ' 00:00:01',
            Carbon::parse($request->end_date)->format('Y-m-d') . ' 23:59:59'
        ]);

        if (!empty($request->jenis)) {
            $data = $data->where('jenis_kolateral', $request->jenis);
        }

        $data = $data->get();

        $nama_table = "CMM";
        $total_pendapatan = [
            'index' => 'Total Nominal CMM',
            'data' => 'Rp' . number_format($data->sum('jumlah_cl')),
            'th' => 'A2', 'td' => 'B2'
        ];

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getSecurity()->setLockWindows(true);
        $spreadsheet->getSecurity()->setLockStructure(true);
        $spreadsheet->getSecurity()->setWorkbookPassword("123");

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue(
            'A1', 'Export Laporan Data ' . ucfirst($nama_table) . 
            ' Periode ' .  date('d/M/y', 
            strtotime($request->start_date)) . ' - ' . date('d/M/y', strtotime($request->end_date))
        );

        $sheet->setCellValue($total_pendapatan['th'], $total_pendapatan['index']);
        $sheet->setCellValue($total_pendapatan['td'], $total_pendapatan['data']);
        $sheet->getStyle($total_pendapatan['td'])->getAlignment()->setHorizontal('center');
        $data_th_for_looping = $this->cmm;

        foreach ($data_th_for_looping as $key => $data_th) {
            #initialize variable for th
            $th = implode(' ', explode('_', ucfirst($data_th)));
            $abjad = $this->abjad[$key];
            $th_start_at =  $this->th_start_at;
            $sheet->setCellValue($abjad . $th_start_at, $th);
            $sum = $this->th_start_at;

            #insert data for td
            foreach ($data as $dataKey => $data_table) {
                $sum += 1;
                if ($data_th == 'terbayar') {
                    $sheet->setCellValue($this->abjad[$key] . $sum, date('d-m-Y', strtotime($data_table->$data_th)));
                } else {
                    $sheet->setCellValue($this->abjad[$key] . $sum, $data_table->$data_th);
                }
            }
        }

        $get_abjad_terakhir = $abjad;
        $styling_full_widht = "A1:$get_abjad_terakhir" . "1";
        #Header Style
        $spreadsheet->getActiveSheet()->mergeCells($styling_full_widht);
        $sheet->getStyle($styling_full_widht)->getAlignment()->setHorizontal('center');
        $sheet->getStyle("A1")->getFont()->setSize(15);
        #th Style
        $sheet->getStyle('A' . $th_start_at . ':' . $get_abjad_terakhir . $th_start_at)->getAlignment()->setHorizontal('center');
        #all style
        $spreadsheet->getActiveSheet()->getDefaultColumnDimension('A')->setWidth(25);

          // =========================================================================

        #new sheet
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Transaction Maker CMM ');
        $produk_terjual = $spreadsheet->addSheet($myWorkSheet, 0);
        $produk_terjual->setCellValue(
            'A1', 'Export Laporan Transaction Maker CMM Periode ' .  
            date('d/M/y', strtotime($request->start_date)) . ' - ' . 
            date('d/M/y', strtotime($request->end_date)
        ));

        $start_from = 2;
        $produk_terjual->setCellValue('A' . $start_from, 'Project Name')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('B' . $start_from, 'Client')->getColumnDimension('A')->setWidth(20);
        $produk_terjual->setCellValue('C' . $start_from, 'Nominal PO')->getColumnDimension('B')->setWidth(20);
        $produk_terjual->setCellValue('D' . $start_from, 'Nama EU')->getColumnDimension('C')->setWidth(20);
        $produk_terjual->setCellValue('E' . $start_from, 'Tanggal Pengajuan')->getColumnDimension('E')->setWidth(20);

        $sum = $start_from;
        foreach ($data as $dataKey => $data_table) {
            $sum += 1;
            foreach ($data_table->tmcmm as $item) {
                $produk_terjual->setCellValue("A$sum", $item->nama_project);
                $produk_terjual->setCellValue("B$sum", $item->nama_klien ?? 'data telah di hapus');
                $produk_terjual->setCellValue("C$sum", $item->nominal_po ?? 'data telah di hapus');
                $produk_terjual->setCellValue("D$sum", $item->nama_eu ?? 'data telah di hapus');
                $produk_terjual->setCellValue("E$sum", $item->tgl_po ?? 'data telah di hapus');
            }
        }
        #styling of trans maker sheet
        $produk_penjualan_header = 'A1:F1';
        $produk_penjualan_th = "A$start_from:F$start_from";
        $produk_terjual->mergeCells($produk_penjualan_header);
        $produk_terjual->getStyle($produk_penjualan_header)->getAlignment()->setHorizontal('center');
        $produk_terjual->getStyle("A1")->getFont()->setSize(15);
        $produk_terjual->getStyle($produk_penjualan_th)->getAlignment()->setHorizontal('center');

        // =============================================================================================
        $writer = new Xlsx($spreadsheet);
        $link = "/export/excel/laporan-CMM.xlsx";
        
        $writer->save('export/excel/laporan-CMM.xlsx');

        $headers = [
            'Content-Type' => 'application/xlsx',
        ];

        return response()->json([
            "status" => "success",
            "link" => $link
        ]);
    }
}
