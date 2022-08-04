<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        "no_so","kode_project","institusi", "project", "hps", "file_quotation", "file_po", "file_spk", "file_dokumen", "jenis_dok", "status"
    ];
    public function listpadmin()
    {
        return $this->belongsTo(ListProjectAdmin::class, 'listpa_id');
    }
}
