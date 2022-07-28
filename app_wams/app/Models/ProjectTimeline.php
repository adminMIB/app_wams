<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeline extends Model
{
    use HasFactory;
    protected $fillable = ["nama_technical", "start_date", "finish_date", "jenis_pekerjaan"];

    public function list_project_teches()
    {
        return $this->belongsTo(ListProjectTech::class,'task_id');
    }
}
