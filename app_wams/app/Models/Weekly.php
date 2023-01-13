<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weekly extends Model
{
    use HasFactory;

    protected $fillable = ["status", "start_date", "end_date", "job_essay", "listL_id", "note", "name_technikal"];


    public function timelines()
    {
        return $this->belongsTo(ProjectTimeline::class, 'listd_id');
    }

    public function reportd()
    {
        return $this->belongsTo(WeeklyReport::class, 'listd_id');
    }

    public function edity()
    {
        return $this->hasMany(WeeklyReport::class, 'listp_id');
    }
    
    public function editpt()
    {
        return $this->hasMany(WeeklyReport::class, 'listp_id');
    }

    
    public function listL()
    {
        return $this->belongsTo(SalesOrder::class, 'listL_id');
    }
    // public function destroyy()
    // {
    //     return $this->belongsTo(WeeklyReport::class, 'listd_id');
    // }

    public function taskdiscussion()
    {
        return $this->hasMany(TaskDiscussion::class);
    }
}
