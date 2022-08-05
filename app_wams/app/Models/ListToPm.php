<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListToPm extends Model
{
    use HasFactory;

    protected $fillable=[
        "no_sales",
        "tgl_sales",
        "kode_project",
        "nama_sales",
        "nama_institusi",
        "nama_project",
        "quantity",
        "hps",
        "sign_pm"
    ];
}
