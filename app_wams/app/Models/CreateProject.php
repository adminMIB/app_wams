<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateProject extends Model
{
    use HasFactory;

    protected $fillable =[
        "id_project","project_name","principal_name","client_name","file","bmt","services","lain","subtotal","bunga_admin","biaya_admin","biaya_pengurangan","total_final"
    ];


    public function detail()
    {
        return $this->hasMany(TransactionMakerACDC::class, 'cpt_id');
    }
}
