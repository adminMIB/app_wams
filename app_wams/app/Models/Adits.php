<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adits extends Model
{
    use HasFactory;
    protected $table = "adits";
    protected $fillable = [
        "name_client",
        "name_project",
    ];

    public function weeklyreport()
    {
        return $this->hasMany(Reports::class);
    }
}
