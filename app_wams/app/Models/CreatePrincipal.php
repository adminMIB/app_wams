<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatePrincipal extends Model
{
    use HasFactory;

    protected $fillable=[
        "principal_type","principal_name"
    ];
}
