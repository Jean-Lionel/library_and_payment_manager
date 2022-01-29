<?php

namespace App\Models;

use App\Models\Cour;
use App\Models\Emprut;
use App\Models\PointEvaluation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Eleve extends Model
{
    use HasFactory;

    use SoftDeletes;

    // protected $fillable = ['first_name','last_name','description','classe_id','anne_scolaire','anne_scolaire_id'];

    protected $guarded = [];

    public function classe(){
    	return $this->belongsTo('App\Models\Classe');
    }

    public function is_a_girl(){
        return $this->sexe == "F";
    }
    public function is_a_boy(){
        return $this->sexe == "M" || $this->sexe == "H";
    }

    public function compte(){
    	return $this->belongsTo('App\Models\Compte','id','eleve_id');
    }

    public function getFullNameAttribute(){
    	return $this->first_name .'  '. $this->last_name;
    } 

    // NIVEAU D'ETUDE
    public function getLevelAttribute(){
        return $this->classe->level->id ?? 0;
    }

    public static function getEleveById($id)
    {
        return self::find($id);
    }

    public function empruts()
    {
        return $this->hasMany(Emprut::class);
    }

    public function listeEmprutNonRemis()
    {
        return "JE suis cool";
    }

    // LES POINTS OBTENUES DANS UN EVALUATION
    public function point_obentu_evaluation($evaluation_id){
        $check = PointEvaluation::where('evaluation_id', '=',$evaluation_id)->where('eleve_id' ,'=',$this->id)->first();
        return  $check ?? new PointEvaluation;
    }

    // LA FONCTION POUR RECUPERER LES POINTS D'UN ELEVE
    // ELEVE 
    // COURS 
    // TRIMESTRE 
    // ANNEE SCOLAIRE 
    // TYPE D'EVALUATION 
    // point_evaluations , cour_id , eleve_id , anne_scolaire_id  ,trimestre_id , type_evaluation

    public function recuperer_point($eleve_id = "" ,$cour_id, $trimestre_id, $anne_scolaire_id, $type_evaluation ){
        
        $choosed_eleve =  $this->id;
        $points = PointEvaluation::where('cour_id', '=', $cour_id)
        ->where('eleve_id','=',$eleve_id ?? $choosed_eleve)
        ->where('trimestre_id','=',$trimestre_id)
        ->where('anne_scolaire_id','=',$anne_scolaire_id)
        ->where('type_evaluation','=',$type_evaluation)
        ->get();
        //CALCULER LA MOYENNE SUR 
        $ponderation = Cour::findOrFail($cour_id)->ponderation;
        if($type_evaluation == 'EXAMEN'){
            $ponderation = Cour::findOrFail($cour_id)->ponderation_examen;
        } 
        if($type_evaluation == 'COMPENTENCE'){
            //COMPETANCE
            $ponderation = Cour::findOrFail($cour_id)->ponderation_compentance;
        }
        //$ponderation = Cour::findOrFail($cour_id)->ponderation;
        //POINT OBTENUE  MOYENNE DU COURS
        if($points->sum('ponderation') != 0){
         $resultat = $points->sum('point_obtenu') * $ponderation / $points->sum('ponderation');
     }else{
        $resultat  = 0;
    }
    return $resultat;
}
    //TYPE DES EVALUATIONS PAR DEFAUT
    // INTERROGATION
    // EXAMEN
    // COMPENTENCE

public function getPointTatalObtenue($eleve_id,$courses,$trimestre_id, $anne_scolaire_id){
   $total = 0;
   $courses_listes = [];
   $nombres_cours = 0;
   $type_evaluations = ['INTERROGATION', 'EXAMEN', 'COMPENTENCE'];
   foreach ($courses as $key => $coursCategorie) {
    $categories = [];
    foreach ($coursCategorie as  $cours) {
        $v = 0;
         $nombres_cours++;
         $detailPoints = [];
        foreach ($type_evaluations as  $evaluation) {
                // code...
            $r = $this->recuperer_point($eleve_id ,$cours->id, $trimestre_id, $anne_scolaire_id, $evaluation );
            $v += $r;
            $detailPoints[$evaluation] =  $r;

        }
         $total += $v;
         $c = [
            'name' => $cours->name,
            'total' => $v,
            'details' => $detailPoints,
            'interrogation' => $detailPoints['INTERROGATION'],
            'examen' => ($detailPoints['EXAMEN'] + $detailPoints['COMPENTENCE']),
            'poderation' => $cours->ponderationTotal,
            //Calcule du profondeur de l'echec point obtenu - 50 % du point total
            'profondeur_echec' => ($v - ( $cours->ponderationTotal / 2)), 
         ];
         $categories[$key][]= $c;
        
    }
        $courses_listes[] = $categories;  
    }

    return [
        'total' => $total,
        'courses_listes' => $courses_listes,
       
    ];
}

}


