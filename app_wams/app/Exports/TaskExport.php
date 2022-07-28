<?php

namespace App\Exports;

use App\Models\Coba;
use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TaskExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //return Coba::all();
    }

    public function headings(): array
    {
      return ["ID :","KODE :", "NAMA :","NAMA PROJECT :","NILAI PROJECT :","NAMA AM :","NAMA PM :","NAMA TECNIKAL :", "STATUS PEKERJAAN :","TANGGAL BUAT :", "TANGGAL UPDATE :" ];
    }
}

