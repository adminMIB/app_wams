<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SalesOpty extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable =[
        "NamaClient","NamaProject","Timeline","Date", "Angka","no_opty","Status","Note","elearning_id", "ID_project", "name_user", "sign_pmLead", "sign_techLead", "distributor", "pmo", "sbu", "presales", "estimated_amount", "confidence_level", "contract_amount", "UploadDocument","no_customer"
    ];

    public function UploadDocuments()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function elearnings()
    {
        return $this->belongsTo(Elearning::class, 'elearning_id');
    }

    public function pmLead()
    {
        return $this->belongsTo(User::class, 'sign_pmLead');
    }

    public function technikelLead()
    {
        return $this->belongsTo(User::class, 'sign_techLead');
    }

    public function userTechnikalsPipe()
    {
        return $this->hasMany(UserHasSalesOpties::class, 'sales_opties_id');
    }

    
}
