<?php

namespace App\Models;

use App\Models\Cour;
use App\Models\CourseCategory;
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
        return $this->categories();
    }

    public function getClasseById($id){
        return self::find($id);
    }

    public function categories(){
        // SELECT DISTINCT CATEGORIE ID , ORDRE FROM CATEGORIES WHERE 
        $categories = array_unique($this->courses()->map->category_id->toArray());
        //sort($categories);


        //Recuperation des category groupe par leur ordre
        $coursCategories = CourseCategory::whereIn('id',$categories)->orderBy('ordre')->get(); 

        //dd($coursCategories->map->ordre);
        $coursCategorie = [];

        foreach ($coursCategories as $key =>  $category ) {
           
            $courses = Cour::where('category_id',$category->id)
                            ->where('level_id', $this->level->id)->get();
            // Selectionner les catégories à afficher

             if ($category->is_primary) {
                 // code...
                $coursCategorie[$category->name] = $courses;
             }else{
                $coursCategorie[$key] = $courses;
             }
             

        }
       // dd($coursCategorie);
        return   $coursCategorie ?? [];
       
    }

    public function ponderation(){
        $total_credit = 0;
        $total_examen = 0;
        $total_interrogation = 0;

        foreach ($this->courses() as $key => $course) {
            // code...
            $total_credit += $course->credit;
            $total_examen += ($course->ponderation_compentance + $course->ponderation_examen);
            $total_interrogation += $course->ponderation;
        }

        return [
            'total_credit' => $total_credit,
            'total_examen' => $total_examen,
            'total_interrogation' => $total_interrogation,
            'total' => $total_interrogation + $total_examen,

        ];
    }
}
