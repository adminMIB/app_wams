<?php

namespace App\Models;

use App\Http\Controllers\API\ElearningController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elearning extends Model
{
    use HasFactory;

    protected $fillable=[
        "implementasi","ele_id"
    ];

    public function eles()
    {
        return $this->belongsTo(ElearnindDetail::class, 'ele_id');
    }
}
