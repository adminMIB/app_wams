<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProjectPm extends Model
{
    use HasFactory;
    protected $fillable =[
        "no_sales",
        "tgl_sales",
        "nama_sales",
        "nama_institusi",
        "nama_project",
        "quantity",
        "hps",
        "sign_pm_lead"
    ];

    // relasi ke category
    public function users()
    {
        return $this->belongsTo(User::class, "sign_pm_lead");
    }
}
