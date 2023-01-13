<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasSalesOpties extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id_technikal',
        'user_id_pm',
        'user_id_presales',
        'model_type',
        'sales_opties_id',
    ];

    public function projectSalesOpties()
    {
        return $this->belongsTo(SalesOpty::class, 'sales_opties_id');
    }

    public function userTechnikal()
    {
        return $this->belongsTo(User::class, 'user_id_technikal');
    }

    public function userPM()
    {
        return $this->belongsTo(User::class, 'user_id_pm');
    }

    public function userPresale()
    {
        return $this->belongsTo(User::class, 'user_id_presales' );
    }

}
