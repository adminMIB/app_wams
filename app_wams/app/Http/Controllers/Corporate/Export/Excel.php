<?php

namespace App\Http\Controllers\Corporate\Export;

use App\Models\CreateClient;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

trait Excel
{
    public static function doExport($project, $transMaker)
    {
        $alfabet = range('A', 'Z');
        $spreadsheet = new Spreadsheet();
        $myWorksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, str_replace(["/", ", "], "", $project['project_name']));
        $report_data = $spreadsheet->addSheet($myWorksheet, 0);
        $report_data->setCellValue('A1', 'Project ' . str_replace(["/", ", "], "", $project['project_name']));
        $start_from = 16;

        // set Header
        $report_data->setCellValue('A3', 'ID Project');
        $report_data->setCellValue('A4', 'Project');
        $report_data->setCellValue('A5', 'BMT Awal');
        $report_data->setCellValue('A6', 'Services');
        $report_data->setCellValue('A7', 'SubTotal');
        $report_data->setCellValue('A8', 'Bunga Admin');
        $report_data->setCellValue('A9', 'Biaya Admin');
        $report_data->setCellValue('A10', 'Biaya Pengurangan');
        $report_data->setCellValue('A11', 'Total Final');
        $report_data->setCellValue('A12', 'File');

        // Set data
        $report_data->setCellValue('B3', $project['id_project'])->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B4', str_replace(["/", ", "], "", $project['project_name']))->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B5', 'Rp. ' . number_format($project['bmt'], 0, ',', '.'))->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B6', 'Rp. ' . number_format($project['services'], 0, ',', '.'))->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B7', 'Rp. ' . number_format($project['subtotal'], 0, ',', '.'))->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B8', $project['bunga_admin'] . ' %')->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B9', 'Rp. ' . number_format($project['biaya_admin'], 0, ',', '.'))->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B10', 'Rp. ' . number_format($project['biaya_pengurangan'], 0, ',', '.'))->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B11', 'Rp. ' . number_format($project['total_final'], 0, ',', '.'))->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B12', $project['file'])->getColumnDimension('B')->setWidth(20);

        $report_data->setCellValue('A14', 'Transaction Maker Project ' . str_replace(["/", ", "], "", $project['project_name']));

        $report_data->setCellValue('A' . $start_from, 'Tanggal')->getColumnDimension('A')->setWidth(20);
        $report_data->setCellValue('B' . $start_from, 'Jenis Transaksi')->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('C' . $start_from, 'Tujuan')->getColumnDimension('C')->setWidth(20);
        $report_data->setCellValue('D' . $start_from, 'Nominal')->getColumnDimension('D')->setWidth(20);
        $report_data->setCellValue('E' . $start_from, 'Keterangan')->getColumnDimension('E')->setWidth(20);

        $sum = $start_from;
        $tally_nominal = 0;
        $remaining = 0;

        foreach ($transMaker as $val) {
            $sum += 1;
            $report_data->setCellValue("A$sum", $val->tanggal);
            $report_data->setCellValue("B$sum", $val->jenis_transaksi);
            $report_data->setCellValue("C$sum", $val->nama_tujuan);
            $report_data->setCellValue("D$sum", $val->nominal);
            $report_data->setCellValue("E$sum", $val->keterangan);

            $tally_nominal += $val->nominal;
        }

        $row_tally = $sum + 2;

        $remaining = $project['total_final'] - $tally_nominal;

        $report_data->setCellValue("A$row_tally", "Total Advance");
        $report_data->setCellValue("B$row_tally", $tally_nominal); // Set Total Advance in column B

        $row_remaining = $row_tally + 1;

        $report_data->setCellValue("A$row_remaining", "Sisa");
        $report_data->setCellValue("B$row_remaining", $remaining); // Set Sisa in column B

        $report_header = 'A1:H1';
        $report_header2 = 'A14:H14';

        $repor_header_th = "A$start_from:H$start_from";

        $report_data->mergeCells($report_header);
        $report_data->mergeCells($report_header2);
        $report_data->getStyle($report_header)->getAlignment()->setHorizontal('center');
        $report_data->getStyle("A1")->getFont()->setSize(15);
        $report_data->getStyle("A14")->getFont()->setSize(15);
        $report_data->getStyle($repor_header_th)->getAlignment()->setHorizontal('center');

        $writer = new Xls($spreadsheet);
        $name = 'export/file-project.xlsx';
        $writer->save($name);

        return  "/" . $name;
    }

    public static function exportReimburse($data, $tm)
    {
        $spreadsheet = new Spreadsheet();
        $myWorksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $data['nama_project']);
        $report_data = $spreadsheet->addSheet($myWorksheet, 0);
        $report_data->setCellValue('A1', 'Cash Advance ' . $data['jenis'] . ' ' . $data['nama_project']);
        $client = CreateClient::find($data['client']);
        $start_from = 9;

        // set Header
        $report_data->setCellValue('A3', 'ID Oppty');
        $report_data->setCellValue('A4', 'Project');
        $report_data->setCellValue('A5', 'PIC Bisnis Channel');
        $report_data->setCellValue('A6', 'Client');

        $report_data->setCellValue('B3', $data['ID_opptyproject'])->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B4', $data['nama_project'])->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B5', $data['pic_bussiness_channel'])->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B6', $client->client_name)->getColumnDimension('B')->setWidth(20);

        $report_data->setCellValue('A7', 'Transaction Maker ' . $data['nama_project']);

        $report_data->setCellValue('A' . $start_from, 'Tanggal')->getColumnDimension('A')->setWidth(20);
        $report_data->setCellValue('B' . $start_from, 'PIC Reimbursement')->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('C' . $start_from, 'Nominal Reimbursement')->getColumnDimension('C')->setWidth(20);
        $report_data->setCellValue('D' . $start_from, 'PIC Business Channel')->getColumnDimension('D')->setWidth(20);
        $report_data->setCellValue('E' . $start_from, 'Client')->getColumnDimension('E')->setWidth(20);
        $report_data->setCellValue('F' . $start_from, 'PIC Client')->getColumnDimension('F')->setWidth(20);

        $sum = $start_from;
        $tally_nominal = 0;

        foreach ($tm as $val) {
            $sum += 1;
            $report_data->setCellValue("A$sum", $val->tanggal_reimbursement);
            $report_data->setCellValue("B$sum", $val->nama_pic_reimbursement);
            $report_data->setCellValue("C$sum", $val->nominal_reimbursement);
            $report_data->setCellValue("D$sum", $val->pic_business_channel);
            $report_data->setCellValue("E$sum", $val->client);
            $report_data->setCellValue("F$sum", $val->pic_client);

            $tally_nominal += $val->nominal_reimbursement;
        }

        $row_tally = $sum + 2;

        $report_data->setCellValue("A$row_tally", "Total Advance");
        $report_data->setCellValue("B$row_tally", $tally_nominal); // Set Total Advance in column B

        $report_header = 'A1:H1';
        $report_header2 = 'A14:H14';

        $repor_header_th = "A$start_from:H$start_from";

        $report_data->mergeCells($report_header);
        $report_data->mergeCells($report_header2);
        $report_data->getStyle($report_header)->getAlignment()->setHorizontal('center');
        $report_data->getStyle("A1")->getFont()->setSize(15);
        $report_data->getStyle("A14")->getFont()->setSize(15);
        $report_data->getStyle($repor_header_th)->getAlignment()->setHorizontal('center');

        $writer = new Xls($spreadsheet);
        $name = 'export/file-reimbursement.xlsx';
        $writer->save($name);

        return  "/" . $name;
    }
}
