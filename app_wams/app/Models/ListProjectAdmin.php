<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ListProjectAdmin extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable =[
        "ID_project", "ID_Customer", "NamaClient","NamaProject","UploadDocument","Date","Status","Note","distributor", "principal", "signTechnikal_id","signAM_id", "name_user"
    ];

    public function UploadDocuments()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function setFilenamesAttribute($value)
    {
        $this->attributes['UploadDocument'] = json_encode($value);
    }
    
    public function Pm()
    {
        return $this->belongsTo(User::class, 'sign_Pm_id');
    }

    public function userTechnikals()
    {
        return $this->hasMany(UserHasListProjectAdmin::class, 'ListProjectAdmin_id');
    }

    public function ltoproject()
    {
        return $this->hasMany(SalesOrder::class, 'listadmin_id');
    }


}
