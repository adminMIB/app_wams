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
        "ID_project", "NamaClient","NamaProject","UploadDocument","Date", "Angka","Status","Note"
    ];

    public function admin_upload()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function setFilenamesAttribute($value)
    {
        $this->attributes['UploadDocument'] = json_encode($value);
    }
    

}
