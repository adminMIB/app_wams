<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProjet extends Model
{
    use HasFactory;

    protected $fillable =[
        "institusi","project"
    ];
}
