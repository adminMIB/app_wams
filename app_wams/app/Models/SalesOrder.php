<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SalesOrder extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        "no_so","kode_project","institusi", "project", "hps", "file_dokumen", "status", "signPm_lead", "signTeknikal_lead", "tgl_so", "name_user", "listpa_id"
    ];
    public function listpadmin()
    {
        return $this->belongsTo(ListProjectAdmin::class, 'listpa_id');
    }

    public function file_dokumens()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function pmLead()
    {
        return $this->belongsTo(User::class, 'signPm_lead');
    }

    public function teknikalLead()
    {
        return $this->belongsTo(User::class, 'signTeknikal_lead');
    }
}
