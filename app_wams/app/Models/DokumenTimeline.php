<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenTimeline extends Model
{
    use HasFactory;

    protected $fillable =[
        "nama_dokumen","upload_dokumen","project_id"
    ];
}
