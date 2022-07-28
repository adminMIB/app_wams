<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable=[
      "kode", "name","name_pro","nilai_pro","name_am","name_pm","name_tec","status", "created_at"
    ];
    
       public function cobas()
       {
        return $this->belongsTo(Coba::class,'name');
       }
    
}
