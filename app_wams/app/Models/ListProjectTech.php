<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProjectTech extends Model
{
    use HasFactory;

    protected $fillable=[
        "nama_client",
        "nama_project",
        "hps",
        "nama_sales",
        "jenis_dokumen",
        "upload_dokumen",
        "user_id",
        "project_id"
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects()
    {
        return $this->belongsTo(SalesOrder::class, 'project_id');
    }
    
}
