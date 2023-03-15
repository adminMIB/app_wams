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
        "file_PHD",
        "file_SPSC",
        "file_PS",
        "note_for_file1",
        "note_for_file2",
        "note_for_file3",
        "status",
        "name_user",
        "Note",
        "no_so",
        "kode_project",
        "institusi",
        "project",
        "tgl_so",
        "file_project",
        "distributor",
        "principal",
        "pmo",
        "sbu",
        "presales",
        "estimated_amount",
        "confidence_level",
        "contract_amount",
        "status_project",
        "total",
        "grandtotal",
        "no_customer",
        "alamat_disti",
        "listadmin_id",
        "listpipe_id",
        "st_project",
        "start_date",
        "end_date"
    ];
    
    public function listadmin()
    {
        return $this->belongsTo(ListProjectAdmin::class, 'listadmin_id');
    }
    
    public function listpipe()
    {
        return $this->belongsTo(SalesOpty::class, 'listpipe_id');
    }

    public function file_dokumens()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function amdetail()
    {
        return $this->hasMany(Amount::class,'salesorders_id');
    }
    
    public function pddetail()
    {
        return $this->hasMany(ProductItem::class,'list_id');
    }
    

    public function listtimeline()
    {
        return $this->hasMany(ListProjet::class,'so_id');
    }


    public function weeklies()
    {
        return $this->hasMany(Weekly::class,'listL_id');
    }

    public function bast()
    {
        return $this->hasMany(Bast::class,'so_id');
    }

    public function dokumen_projects()
    {
        return $this->hasMany(DokumenProject::class,'so_id');
    }

    public function pps()
    {
        return $this->hasMany(PenawaranPesanan::class,'lto_id');
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class, 'lto_id');
    }

     public function file_PHDs()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function setFilenamesAttribute($value)
    {
        $this->attributes['file_PHD'] = json_encode($value);
    }

}
