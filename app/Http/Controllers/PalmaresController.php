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
      $nombres_cours = $data['nombres_cours'];
      return view('bulletin.palmares', compact('palmares','courses','nombres_cours'));   
    // CALCULER TOUT LES NOTES
    // CALCULER LE POURCENTAGE
    // ORDONNER LES NOTES
   }

   public static function getNote($annee_scolaire_id, $classe_id, $trimestre){
      $c = Classe::findOrFail($classe_id);
      $ponderation_total = $c->ponderation();
      $level = $c->level;
      $max_total = $level->getMaxTotal();
      $nombres_cours = $c->courses()->count();
      // Liste des cours
      $courses = $c->courseCategories();

      $eleves = Eleve::where('anne_scolaire_id', $annee_scolaire_id)
                        ->where('classe_id',$classe_id)->get();
      $palmares = [];
      foreach ($eleves as $key => $eleve) {
         // code...
         $v = $eleve->getPointTatalObtenue($eleve->id,$courses,$trimestre, $annee_scolaire_id);
         $eleve->points = $v['total'];
         $eleve->courses_listes = $v['courses_listes'];

         if ($trimestre == 1) {
            // code...
            $eleve->trimestre = [
               'TRIMESTRE_1' => 1,
               'TRIMESTRE_2' => 1,
               'TRIMESTRE_3' => 1,
            ];
         }
         
         $eleve->points_total = $v['points_total'];
         $eleve->pourcentage = getPourcentage($v['total'], $ponderation_total['total']) ;
         $palmares[] = $eleve;
      } 

      $palmares = collect($palmares)->sortByDesc('points');

      return [
         'palmares' => $palmares,
         'courses' => $courses,
         'trimestre' => $trimestre,
         'nombres_cours' => $nombres_cours,
         'ponderation_total' => $ponderation_total
      ];
   }

   private function getPlace(){
      
   }

}
