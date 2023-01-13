<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Customer extends Model
{
    use HasFactory;

    protected $fillable=[
        "nama", "IDCustomer", "email", "no_telp", "alamat", "nama_pic", "jabatan_pic", "no_hp"
    ];


}

