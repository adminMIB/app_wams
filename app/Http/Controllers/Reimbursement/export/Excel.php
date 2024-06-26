<?php

namespace App\Http\Controllers\Reimbursement\export;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

trait Excel
{
    public static function doExportReimbursement($project, $transMaker)
    {
        $spreadsheet = new Spreadsheet();
        $myWorksheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $project->nama_project);
        $spreadsheet->addSheet($myWorksheet, 0);
        $report_data = $spreadsheet->setActiveSheetIndex(0);
        $report_data->setTitle($project->nama_project);
        
        $report_data->setCellValue('A1', 'Project ' . $project->nama_project);
        $start_from = 16;

        // set Header
        $report_data->setCellValue('A3', 'ID Project');
        $report_data->setCellValue('A4', 'Project');
        $report_data->setCellValue('A5', 'Customer');
        $report_data->setCellValue('A6', 'PIC');
        $report_data->setCellValue('A7', 'Keterangan');
        $report_data->setCellValue('A8', 'File');
        $report_data->setCellValue('A9', 'Tangggal');

        // Set data
        $report_data->setCellValue('B3', $project->id_reimbursement)->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B4', $project->nama_project)->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B5', $project->customer)->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B6', $project->pic_bussiness_channel)->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B7', $project->keterangan)->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B8', $project->file)->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('B9', $project->created_at)->getColumnDimension('B')->setWidth(20);

        $report_data->setCellValue('A14', 'Transaction Maker Project ' . $project->nama_project);

        $report_data->setCellValue('A' . $start_from, 'Tanggal')->getColumnDimension('A')->setWidth(20);
        $report_data->setCellValue('B' . $start_from, 'Nama PIC')->getColumnDimension('B')->setWidth(20);
        $report_data->setCellValue('C' . $start_from, 'Nominal')->getColumnDimension('C')->setWidth(20);
        $report_data->setCellValue('D' . $start_from, 'Keterangan')->getColumnDimension('E')->setWidth(20);

        $sum = $start_from;

        // Loop untuk mengisi data transaksi
        foreach($transMaker as $val) {
            $sum += 1;
            $report_data->setCellValue("A$sum", $val->tanggal);
            $report_data->setCellValue("B$sum", $val->nama_pic);
            $report_data->setCellValue("C$sum", $val->nominal);
            $report_data->setCellValue("D$sum", $val->keterangan);
        }

        $report_header = 'A1:H1';
        $report_header2 = 'A14:H14';
        $repor_header_th = "A$start_from:H$start_from";

        $report_data->mergeCells($report_header);
        $report_data->mergeCells($report_header2);
        $report_data->getStyle($report_header)->getAlignment()->setHorizontal('center');
        $report_data->getStyle("A1")->getFont()->setSize(15);
        $report_data->getStyle("A14")->getFont()->setSize(15);
        $report_data->getStyle($repor_header_th)->getAlignment()->setHorizontal('center');

        $writer = new Xlsx($spreadsheet);
        $name = 'export/file-project-internal-' . time() . '.xlsx';
        $writer->save($name);

        return  "/" . $name;
    }
}
