<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wodlist extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "status", "quantity", "salesorder_id", "salesopty_id" 
    ];

    public function sorder()
    {
        return $this->belongsTo(ListProjectAdmin::class, 'salesorder_id');
    }

    public function sopty()
    {
        return $this->belongsTo(SalesOpty::class, 'salesopty_id');
    }
}
