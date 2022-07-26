<?php

namespace App\Exports;

use App\Models\SalesOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SoExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SalesOrder::select('id', 'no_so', 'created_at', 'institusi', 'project', 'status', 'hps', 'jenis_dok', 'file_dokumen')->get();
    }

    public function headings(): array{
        return ["ID","No Sales Order","TGL Project","Nama Institusi","Nama Project","Status","HPS","Jenis Dokumen","File"];
    }

}