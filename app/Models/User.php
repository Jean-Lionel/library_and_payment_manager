<?php

namespace App\Models;

use App\Models\Professeur;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'ecole_id',
        'image_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function professeur(){

        return $this->belongsTo(Professeur::class, 'id','user_id');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }
    //Role OF MY USERS

    public function isAdmin()
    {
        return $this->roles()->where('name','ADMINSTRATEUR')->first();
    }

     public function isPrefet()
    {
        return $this->roles()->where('name','PREFETS DES ETUDES')->first();
    }

    public function isProfesseur()
    {
        return $this->roles()->where('name','PROFESSEUR')->first();
    }
    public function isBibliothequaire()
    {
        return $this->roles()->where('name','BIBLIOTHEQUAIRE')->first();
    }
    public function isParent()
    {
        return $this->roles()->where('name','PARENT')->first();
    }
    public function isDirecteur()
    {
        return $this->roles()->where('name','DIRECTEUR')->first();
    }
    public function isComptable()
    {
        return $this->roles()->where('name','COMPTABLE')->first();
    }
    public function isSecretaire()
    {
        return $this->roles()->where('name','SECRETAIRE')->first();
    }
    public function isCantine()
    {
        return $this->roles()->where('name','GERANT QUANTINE')->first();
    }

    public function isDirecteurDispline()
    {
        return $this->roles()->where('name', 'DIRECTEUR-DISIPLINE')->first();
    }


}
