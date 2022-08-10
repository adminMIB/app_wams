<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProjet extends Model
{
    use HasFactory;

    protected $fillable =[
        "nama_institusi","nama_project","no_sales","tgl_sales","kode_project","hps","nama_sales"
    ];

    public function detail()
    {
        return $this->hasMany(ProjectTimeline::class,'list_id');
    }

    public function edit()
    {
        return $this->hasMany(ProjectTimeline::class,'list_id');
    }
}
