<?php

namespace App\Exports;

use App\Models\SalesOpty;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SalesOptyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SalesOpty::all();
    }

    public function headings(): array
    {
       return  ["ID", "NAMA CLIENT", "NAMA PROJECT", "TIMELINE", "DATE", "ANGKA", "STATUS", "NOTE", "CREATED_AT", "UPDATED_AT", "ELEARNING_ID"];
    }
}
