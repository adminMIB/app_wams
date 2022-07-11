<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewWeeklyReport extends Model
{
    use HasFactory;
    protected $fillable = ["nama_client", "nama_project", "uraian_pekerjaan", "date", "status", "note"];
}
