<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
class ListProjet extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        "nama_institusi", "nama_project", "no_sales", "tgl_sales", "so_id", "kode_project", "hps", "nama_sales","nama_dokumen","upload_dokumen"
    ];
    public function upload_documents()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function setFilenamesAttribute($value)
    {
        $this->attributes['upload_dokumen'] = json_encode($value);
    }

    public function sorders()
    {
        return $this->belongsTo(SalesOrder::class, 'so_id');
    }

    public function detail()
    {
        return $this->hasMany(ProjectTimeline::class, 'list_id');
    }

    public function added()
    {
        return $this->hasMany(ProjectTimeline::class, 'id');
    }

    // public function timeline()
    // {
    //     return $this->hasMany(ProjectTimeline::class,'');
    // }

    public function edit()
    {
        return $this->hasMany(ProjectTimeline::class, 'list_id');
    }
    public function weeklyreport()
    {
        return $this->hasMany(ProjectTimeline::class, 'list_id');
    }

    public function userpm()
    {
        return $this->hasMany(ProjectTimeline::class, 'list_id');
    }
}
