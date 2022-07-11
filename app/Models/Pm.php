<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pm extends Model
{
    use HasFactory;
    protected $fillable = ["name", "password", "email", "role", "projectTimeLine_id", "viewWeeklyReport_id"];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ini relasi ke project TimeLine
    public function projectTimeLine() 
    {
        return $this->belongsTo(ProjectTimeline::class, "projectTimeLine_id");
    }
     // ini relasi ke project viewwekly
    public function ViewWeekly() 
    {
        return $this->belongsTo(ViewWeeklyReport::class, "viewWeeklyReport_id");
    }



}
