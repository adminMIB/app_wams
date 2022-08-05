<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeline extends Model
{
    use HasFactory;
    protected $fillable = ["nama_technical", "start_date", "finish_date", "jenis_pekerjaan","list_id"];

    public function lists()
    {
        return $this->belongsTo(ListProjet::class, 'list_id');
    }

    public function project_teches()
    {
        return $this->belongsTo(ListProjectTech::class);
    }
}
