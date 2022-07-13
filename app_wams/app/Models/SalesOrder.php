<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        "no_so","tgl_order","institusi", "project", "hps", "file_quotation", "file_po", "file_spk", "status"
    ];
}
