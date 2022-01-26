<?php

namespace App\Models;

use App\Models\Cour;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classe extends Model
{
   
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','section_id','level_id'];

    public function section()
    {
    	return $this->belongsTo('App\Models\Section'); 	
    }

    public function eleves(){
    	return $this->hasMany('App\Models\Eleve');
    }

    public function nombre_eleves(){
        return count($this->eleves);
    }

    public function courses(){
        return $this->hasMany(Cour::class);
    }

    public function courseCategories(){
        $categories = [];
        foreach($this->courses as $course ){

            if(!in_array($course->category, $categories)){
                 $categories[$course->category->name ?? ""] = $course->category->courses ?? "";
                 //dump($course->category->name ?? "");
            }
            //POUR LES COURS QUI N'APPARTIENT A AUCUNE CATEGORIES

            if(!isset($course->category)){
                $categories["AUTRES"][] = $course;
            }
        }
        return $categories;
    }

    public function getClasseById($id){
        return self::find($id);
    }
}
