<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElearnindDetail extends Model
{
    protected $fillable=[
        "produk","principle","deskripsi","upload"
    ];

    public function elearn()
    {
        return $this->hasMany(Elearning::class, 'ele_id');
    }
}
