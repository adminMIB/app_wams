<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;
    protected $fillable =[
        "name_institusi",
        "name_project",
        "name_am",
        "hps",
        "status_approve"
    ];
}
