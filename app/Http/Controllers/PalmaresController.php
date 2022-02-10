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
      /*$eleves = self::get_eleve_en_ordre($all_eleves,$annee_scolaire_id, $trimestre);*/

      $palmares = [];
      foreach ($eleves as $key => $eleve) {
         // code...
         $v = $eleve->getPointTatalObtenue($eleve->id,$courses,$trimestre, $annee_scolaire_id);
         // Recupérer les points du premier Trimestre

         if ($eleve->is_nonClasse($trimestre, $annee_scolaire_id)) {
            // code...
            $eleve->isNonClasse = true;
         }else{
           $eleve->isNonClasse = false;
           $eleve->points = $v['total'];
        }
        $eleve->courses_listes = $v['courses_listes'];
            // code...

        $eleve->points_total = $v['points_total'];
        $eleve->pourcentage = getPourcentage($v['total'], $ponderation_total['total']) ;



        $palmares[] = $eleve;
     } 
      //dd($palmares);
     $palmares = collect($palmares)->sortByDesc('points');

     return [
      'palmares' => $palmares,
      'courses' => $courses,
      'trimestre' => $trimestre,
      'nombres_cours' => $nombres_cours,
      'ponderation_total' => $ponderation_total
   ];
}

public static function get_eleve_en_ordre($all_eleves,$anne_scolaire_id,$trimestre){
   $order = [];
   $non_classes = [];
   foreach ($all_eleves as $eleve){
      if (!$eleve->is_nonClasse($trimestre, $anne_scolaire_id)) {
         $order[] = $eleve;
      }else{
         $non_classes[] = $eleve;
      }
   }

   return $order;
}

public function getNoteAllTrimestre($annee_scolaire_id, $classe_id){

   $c = Classe::findOrFail($classe_id);
      $ponderation_total = $c->ponderation();
      $level = $c->level;
      $max_total = $level->getMaxTotal();
      $nombres_cours = $c->courses()->count();
      // Liste des cours
      $courses = $c->courseCategories();

      $eleves = Eleve::where('anne_scolaire_id', $annee_scolaire_id)
      ->where('classe_id',$classe_id)->get();

      /*$eleves = self::get_eleve_en_ordre($all_eleves,$annee_scolaire_id, $trimestre);*/
      $palmares = [];
      foreach ($eleves as $key => $eleve) {
         $t = [];
         // Recuperation des points pour chaque trimestre
         for ($i=1; $i <=3 ; $i++) { 
            // code...
            $t[$i] = $eleve->getPointTatalObtenue($eleve->id,$courses,$i, 
               $annee_scolaire_id);
            $t[$i]['isNonClasse'] = $eleve->is_nonClasse($i, $annee_scolaire_id);
            $t[$i]['pourcentage'] = getPourcentage( $t[$i]['total'], $ponderation_total['total']);
            $t[$i]['place'] = [];
         }

        $eleve->trimestre = $t;
        $eleve->courses_listes = $t[1]['courses_listes'];

         //dd($eleve);
        $palmares[] = $eleve;
     } 
      //dd($palmares);

     $palmares = self::getDataOrderby($palmares);
     //$palmares = collect($palmares)->sort();

     return [
      'palmares' => $palmares,
      'courses' => $courses,
      'nombres_cours' => $nombres_cours,
      'ponderation_total' => $ponderation_total
   ];
}

private static function getDataOrderby($palmares)
{
   // code...
   $trimestre_1 =  collect($palmares)->SortByDesc('trimestre.1.pourcentage')->toArray();
   $trimestre_2 =  collect($palmares)->SortByDesc('trimestre.2.pourcentage')->toArray();
   $trimestre_3 =  collect($palmares)->SortByDesc('trimestre.3.pourcentage')->toArray();

   //dd( $trimestre_1 );

   $data = [];
   $place = 1;


   foreach ($trimestre_1 as $key => $eleve){
      $eleve['trimestre'][1]['place'] = $place;
      $place++;
      $data[] = $eleve;
   }

  
   return collect($data);
}

}
