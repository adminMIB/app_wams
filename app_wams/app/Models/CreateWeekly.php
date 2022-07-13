<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateWeekly extends Model
{
    use HasFactory;

    protected $fillable = [
        "client_name",
        "project_name",
        "uraian_job",
        "start_date",
        "end_date",
        "status_job",
        "note",
    ];
}
