<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasListProjectAdmin extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id_technikal',
        'user_id_presale',
        'user_id_pm',
        'ListProjectAdmin_id',
        "user_id_am"
    ];

    public function projectSalesOrder()
    {
        return $this->belongsTo(ListProjectAdmin::class, 'ListProjectAdmin_id');
    }

    public function userTechnikal()
    {
        return $this->belongsTo(User::class, 'user_id_technikal');
    }

    public function userPresale()
    {
        return $this->belongsTo(User::class, 'user_id_presale');
    }

    public function userPM()
    {
        return $this->belongsTo(User::class, 'user_id_pm');
    }

    public function AM()
    {
        return $this->belongsTo(User::class, 'user_id_am');
    }


    
    
}
