<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        "no_doc","tgl_up","institusi", "project", "jenis_doc","up_doc"
    ];
}
