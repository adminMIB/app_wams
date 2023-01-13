<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenProject extends Model
{
    use HasFactory;

    protected $fillable=[
        "dokumen_project","so_id","deskripsi"
    ];

    public function lto()
    {
        return $this->belongsTo(SalesOrder::class, 'so_id');
    }
}
