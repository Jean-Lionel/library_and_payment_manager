<?php

namespace App\Models;

use App\Models\Auteur;
use App\Models\Classement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function author()
    {
    	return $this->belongsTo(Auteur::class,  'auteur_id','id');
    }

    public function classement()
    {
    	return $this->belongsTo(Classement::class,  'classement_id' , 'id');
    }
}

