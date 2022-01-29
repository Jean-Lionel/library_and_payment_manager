<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Eleve;
use Illuminate\Http\Request;
use PDF;

class PalmaresController extends Controller
{
   
   public  function getPalmares($annee_scolaire_id, $classe_id, $trimestre){

      // $pdf = PDF::loadView('bulletin.palmares', compact('palmares','courses'));

      $data = self::getNote($annee_scolaire_id, $classe_id, $trimestre);
      //  return $pdf->stream();
      $palmares = $data['palmares'];
      $courses = $data['courses'];
      return view('bulletin.palmares', compact('palmares','courses'));   
    // CALCULER TOUT LES NOTES
    // CALCULER LE POURCENTAGE
    // ORDONNER LES NOTES
   }

   public static function getNote($annee_scolaire_id, $classe_id, $trimestre){
      $c = Classe::find($classe_id);
      $level = $c->level;

      $max_total = $level->getMaxTotal();

      // Liste des cours
      $courses = $c->courses();
      $eleves = Eleve::where('anne_scolaire_id', $annee_scolaire_id)
                        ->where('classe_id',$classe_id)->get();
      $palmares = [];
      foreach ($eleves as $key => $eleve) {
         // code...
         $v = $eleve->getPointTatalObtenue($eleve->id,$courses,$trimestre, $annee_scolaire_id);
         $eleve->points = $v['total'];
         $eleve->courses_listes = $v['courses_listes'];
         $eleve->pourcentage = getPourcentage($v['total'], $max_total['total']) ;
         $palmares[] = $eleve;
        
      } 

      $palmares = collect($palmares)->sortByDesc('points');

      return [
         'palmares' => $palmares,
         'courses' => $courses,
         'trimestre' => $trimestre
      ];
   }
}
