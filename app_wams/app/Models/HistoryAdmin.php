<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryAdmin extends Model
{
    use HasFactory;

    protected $fillable =[
        "ID_project", "ID_Customer","NamaClient","NamaProject","UploadDocument","Date","Status","Note","distributor", "principal", "signTechnikal_id","signAM_id", "name_user"
    ];

    public function Pm()
    {
        return $this->belongsTo(User::class, 'sign_Pm_id');
    }

    public function userTechnikals()
    {
        return $this->hasMany(UserHasListProjectAdmin::class, 'ListProjectAdmin_id');
    }
}
