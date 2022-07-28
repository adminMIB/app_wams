<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyReport extends Model
{
    use HasFactory;
    protected $table = 'weekly_reports';
    protected $fillable = [
        "name_client",
        "name_project",
        "job_essay",
        "start_date",
        "end_date",
        "status",
        "note",
    ];
}
