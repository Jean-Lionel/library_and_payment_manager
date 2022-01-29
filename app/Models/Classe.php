<?php

namespace App\Models;

use App\Models\Cour;
use App\Models\Eleve;
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
    public function level()
    {
        return $this->belongsTo('App\Models\Level');  
    }

    public function courses(){
        return $this->level->courses ?? [];
    }

    public function eleves(){
    	return $this->hasMany('App\Models\Eleve');
    }

    public function getEleveByAnneScolaireId($anne_scolaire_id){
        $eleves = Eleve::where('anne_scolaire_id', $anne_scolaire_id)
                        ->where('classe_id', $this->id)->get();
        return $eleves;
    }

    public function getEffectifParClasse($anne_scolaire_id){
       
        $garcons = 0;
        $filles = 0;
        $total = 0;
        
        foreach($this->getEleveByAnneScolaireId($anne_scolaire_id) as $eleve){
            if($eleve->is_a_girl())
                $filles++;
            if($eleve->is_a_boy())
                $garcons++;
            $total++;
        }

        return [
            "name" => $this->name ,
            "g" => $garcons, 
            "p_g" => getPourcentage($garcons , $total ), 
            "f" => $filles,
            "p_f" => getPourcentage($filles , $total ),
            "total" =>  $total
        ];
    }

    public function nombre_eleves(){
        return count($this->eleves ?? 0);
    }

  

    public function courseCategories(){
        $categories = [];
        foreach($this->courses() as $course ){

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
