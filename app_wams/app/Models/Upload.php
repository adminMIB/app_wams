<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable =[
        "no_dokumen","tgl_upload","nama_institusi","nama_project","jenis_dokumen","upload_dokumen"
    ];
}
