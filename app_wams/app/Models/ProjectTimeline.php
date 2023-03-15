<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectTimeline extends Model
{
    use HasFactory;

    protected $fillable = ["nama_technical", "start_date", "finish_date", "jenis_pekerjaan", "list_id","nama_pm"];

    public function lists()
    {
        return $this->belongsTo(ListProjet::class, 'list_id');
    }

    public function timeline()
    {
        return $this->hasMany(ListProjet::class,'so_id');
    }
    
    public function userspm()
    {
        return $this->belongsTo(ListProjet::class,'list_id');
    }
    
    public function weeklies()
    {
        return $this->hasMany(Weekly::class, 'listL_id');
    }
}
