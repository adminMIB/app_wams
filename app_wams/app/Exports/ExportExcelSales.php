<?php

namespace App\Exports;

use App\Models\SalesOpty;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportExcelSales implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SalesOpty::all();
    }
}
