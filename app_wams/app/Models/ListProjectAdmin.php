<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProjectAdmin extends Model
{
    use HasFactory;
    protected $fillable =[
        "NamaClient","NamaProject","Date", "Angka","Status","Note", "signPm_lead", "signTechnikel_lead"
    ];
    
    public function pmLead()
    {
        return $this->belongsTo(User::class, 'signPm_lead');
    }

    public function technikelLead()
    {
        return $this->belongsTo(User::class, 'signTechnikel_lead');
    }
}
