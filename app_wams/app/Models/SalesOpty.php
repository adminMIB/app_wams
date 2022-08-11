<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOpty extends Model
{
    use HasFactory;

    protected $fillable =[
        "NamaClient","NamaProject","Timeline","Date", "Angka","Status","Note","elearning_id", "pmLead_id", "TechnikalLead_id"
    ];

    public function elearnings()
    {
        return $this->belongsTo(Elearning::class, 'elearning_id');
    }

    public function pmLead()
    {
        return $this->belongsTo(User::class, 'pmLead_id');
    }

    public function technikelLead()
    {
        return $this->belongsTo(User::class, 'TechnikalLead_id');
    }
}
