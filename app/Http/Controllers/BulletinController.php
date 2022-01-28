<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateBulletinRequest;
use App\Models\AnneScolaire;
use App\Models\Bulletin;
use App\Models\Classe;
use App\Models\Cour;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\PointEvaluation;
use App\Models\Section;
use App\Models\Trimestre;
use Illuminate\Http\Request;
use PDF;


class BulletinController extends Controller
{
    // id = classe_id
    // x = annee_scolaire_id
    public function bulletin($id){
        $classe_id = $id;
        $anne_scolaire_id = \Request::get('x');

        $anneScolaire = AnneScolaire::find($anne_scolaire_id);

        $selectClasse = Classe::find($classe_id );

        $courseCategories = Classe::find($classe_id) ? Classe::find($classe_id)->courseCategories() : [];
        return view('bulletin.show',  compact('anneScolaire','anne_scolaire_id','selectClasse','courseCategories'));
    }

    public function liste_point(){
        //CLASSE
        //COURS
        //TRIMESTRE
        // ANNEE SCOLAIRE

        return view('bulletin.liste_point');
    }

    public function notes(){

        $sections =  Section::all();
        $trimestres =  Trimestre::all();
        $select_section = \Request::get('section') ?? 0;
        $select_classe = \Request::get('classe_id') ?? 0;

        $classes = Classe::where('section_id',$select_section)->get() ?? [];

        $choosedClasse = Classe::find($select_classe);

        if(!$choosedClasse)
            $choosedClasse = new Classe;
        $annee_scolaires = AnneScolaire::latest()->get();
        return view('bulletin.notes', compact('sections', 'select_section', 'trimestres', 'classes', 'choosedClasse','annee_scolaires', 'select_classe'));
    }


    public function get_notes(Request $request){

      //"section_id = $request->
      // "classe_id" => "1"
      // "cours_id" => "1"
      // "trimestre" => "2"
      // "annee_scolaire" => "1"//"section_id" => "1"

      $classe_id = $request->classe_id;
      $cours_id = $request->cours_id;
      $trimestre = $request->trimestre;
      $anne_scolaire_id = $request->annee_scolaire;


      $eleves = Eleve::where('classe_id', $classe_id)
      ->where('anne_scolaire_id',$anne_scolaire_id)
      ->orderByRaw('first_name')
      ->orderByRaw('last_name')
      ->get();

      if( $trimestre == 'FICHE'){
        // Retourne le fiche des points de tout les trimestre condanse
       return $this->getAllTrimestre($eleves,$cours_id,$anne_scolaire_id);
      }else{

        return $this->getOneTrimestre($eleves,$cours_id,$anne_scolaire_id,$trimestre);
      }
  }

  private function getAllTrimestre($eleves,$cours_id,$anne_scolaire_id){
    // 

    $data = [];

    foreach ($eleves as $key => $eleve) {
        // code...
       // $type_evaluation = INTERROGATION | EXAMEN | COMPENTENCE
       // $type_evaluation = INTERROGATION | EXAMEN | COMPENTENCE
        
        $trimestre = [];
        $total_annuel = 0;

        for($i=1; $i<=3; $i++){
              $trimestre[$i]['INTERROGATION'] = $eleve->recuperer_point($eleve->id ,$cours_id, $i, $anne_scolaire_id, 'INTERROGATION' );

              $trimestre[$i]['COMPENTENCE'] = $eleve->recuperer_point($eleve->id ,$cours_id, $i, $anne_scolaire_id, 'COMPENTENCE' );

              $trimestre[$i]['EXAMEN'] = $eleve->recuperer_point($eleve->id ,$cours_id, $i, $anne_scolaire_id, 'EXAMEN' );

              $trimestre[$i]['TOTAL'] = $trimestre[$i]['INTERROGATION'] +$trimestre[$i]['COMPENTENCE'] + $trimestre[$i]['EXAMEN'];
              $total_annuel +=  $trimestre[$i]['TOTAL'];

        }
       
        $v['eleve'] = $eleve;
        $v['points'] = $trimestre;
        $v['total_annuel'] = $total_annuel;

        $data[] = $v;
    }

    $cours = Cour::find($cours_id);

    $max_total = $cours->ponderation + $cours->ponderation_compentance  + $cours->ponderation_examen ;

     // $pdf = PDF::loadView("bulletin.fiche_point", compact('data', 'cours','max_total'));

    //return $pdf->stream($cours->name . '.pdf');


     return view("bulletin.fiche_point", compact('data', 'cours','max_total'));
  }

  private function getOneTrimestre($eleves,$cours_id,$anne_scolaire_id,$trimestre){

    $listes_points = [];
    foreach($eleves as $eleve){
        $v = [];
        $v['nom'] = $eleve->first_name;
        $v['prenom'] = $eleve->last_name;
        $points = PointEvaluation::where('cour_id', '=', $cours_id)
        ->where('eleve_id','=',$eleve->id)
        ->where('trimestre_id','=',$trimestre)
        ->where('anne_scolaire_id','=',$anne_scolaire_id)
        ->where('type_evaluation','=','INTERROGATION')
        ->get();
        $v['points'] = $points;
        $listes_points[] = $v;

    }

    $cours = Cour::find($cours_id);
    $evaluations = Evaluation::where('cour_id', '=', $cours_id)
    ->where('trimestre','=',$trimestre)
    ->where('anne_scolaire_id','=',$anne_scolaire_id)
    ->where('type_evaluation','=','INTERROGATION')
    ->get();

    $pdf = PDF::loadView('bulletin.liste_point', compact('listes_points','evaluations','cours'));

    return $pdf->stream('test.pdf');

}
}
