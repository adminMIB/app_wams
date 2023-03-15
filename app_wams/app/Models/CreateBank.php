<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateBank extends Model
{
    use HasFactory;

    protected $fillable =[
        "nama_bank" ,"alamat","pic_bank","email_pic_bank","hp_pic_bank"
    ];
}
