<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskDiscussion extends Model
{
    use HasFactory;

    protected $table='task_discussions';
    protected $guarded=['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function weekly()
    {
        return $this->belongsTo(Weekly::class);
    }

    public function child()
    {
        return $this->hasMany(TaskDiscussion::class,'parent_id');
    }
}
