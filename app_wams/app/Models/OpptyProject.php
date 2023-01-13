<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpptyProject extends Model
{
    use HasFactory;

    protected $fillable=[
        "jenis", "ID_opptyproject", "nama_project", "pic_bussiness_channel", "client"
    ];
}
