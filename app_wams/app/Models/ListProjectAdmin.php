<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListProjectAdmin extends Model
{
    use HasFactory;
    protected $fillable =[
        "NamaClient","NamaProject","UploadDocument","Date", "Angka","Status","Note", "signPm_lead", "signTechnikel_lead", "signAmSales_id"
    ];

    public function setFilenamesAttribute($value)
    {
        $this->attributes['UploadDocument'] = json_encode($value);
    }
    
    public function pmLead()
    {
        return $this->belongsTo(User::class, 'signPm_lead');
    }

    public function technikelLead()
    {
        return $this->belongsTo(User::class, 'signTechnikel_lead');
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'signAmSales_id');
    }
}
