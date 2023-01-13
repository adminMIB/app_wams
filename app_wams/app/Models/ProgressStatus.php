<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressStatus extends Model
{
    use HasFactory;

    protected $fillable = ["title", "level"];
}
