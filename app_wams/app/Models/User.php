<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // buat relasi ke roles

    public function listAdmin()
    {
        return $this->belongsTo(ListProjectAdmin::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // // buat variabel buat role
    // const Super_Admin = 0;
    // const AM_SALES = 1;
    // const PM = 2;
    // const Finance = 3;
    // const Management = 4;
    // const Technikal = 5;
    

    //  // buat SUPER ADMIN
    // public function superAdmin()
    // {
    //     return $this->role === self::Super_Admin;
    // }

    //  // buat AM_SALES
    // public function amSales()
    // {
    //     return $this->role === self::AM_SALES;
    // }

    //  // buat PM
    // public function pM()
    // {
    //     return $this->role === self::PM;
    // }

    //  // buat Finance
    // public function finance()
    // {
    //     return $this->role === self::Finance;
    // }

    //  // buat Management
    // public function management()
    // {
    //     return $this->role === self::Management;
    // }

    //  // buat Technikal
    // public function technikal()
    // {
    //     return $this->role === self::Technikal;
    // }
}
