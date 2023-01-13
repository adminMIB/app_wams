<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateClient extends Model
{
    use HasFactory;

    protected $fillable =[
        "client_type","client_name"
    ];
}
