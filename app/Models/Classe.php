<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
   
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','section_id'];

    public function section()
    {
    	return $this->belongsTo('App\Models\Section'); 	
    }

    public function eleves(){
    	return $this->hasMany('App\Models\Eleve');
    }
    public function cours(){
        return $this->hasMany('App\Models\Cour');
    }

    public function getClasseById($id){
        return self::find($id);
    }
}
