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

public function getNoteAllTrimestre($annee_scolaire_id, $classe_id,$trimestre_id){

   $c = Classe::findOrFail($classe_id);
      $ponderation_total = $c->ponderation();

      //dd( $ponderation_total);
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
         $afficher_total_annuel = 0;

         for ($i=1; $i <=3 ; $i++) { 
            // code...
            $t[$i] = $eleve->getPointTatalObtenue($eleve->id,$courses,$i, 
               $annee_scolaire_id);
           
            $t[$i]['isNonClasse'] = $eleve->is_nonClasse($i, $annee_scolaire_id) ? 1 : 0;

            if ($t[$i]['isNonClasse'] == 1) {
               // code...
               $afficher_total_annuel = 1;
            }
            $a = $eleve->is_nonClasse($i, $annee_scolaire_id);
           // dd($a);

            $t[$i]['pourcentage'] = getPourcentage( $t[$i]['total'], $ponderation_total['total']);
            $t[$i]['place'] = [];
         }
        $eleve->trimestre = $t;
        $eleve->afficher_total_annuel =  $afficher_total_annuel;
        $eleve->courses_listes = $t[1]['courses_listes'];

        $palmares[] = $eleve;
     } 
     // dd($palmares);

     $palmares = self::getDataOrderby($palmares, $trimestre_id);
     //$palmares = collect($palmares)->sort();

     return [
      'palmares' => $palmares,
      'courses' => $courses,
      'nombres_cours' => $nombres_cours,
      'ponderation_total' => $ponderation_total,
      'classe' => $c,
   ];
}

private static function getDataOrderby($palmares, $trimestre_id)
{
   // Place TRIMESTRE 1...
   $trimestre_1 = collect($palmares)->SortByDesc('trimestre.1.pourcentage')->values();
   /*$trim1 = collect($palmares)->groupBy('trimestre.1.isNonClasse');

   $trimestre_1 =  $strim1[0]->SortByDesc('trimestre.1.pourcentage')->values();
   dd($trimestre_1->toArray());*/


   $trimestre_1_tj =  collect($palmares)->SortByDesc('trimestre.1.points_total.INTERROGATION')->values();
   $trimestre_1_ex =  collect($palmares)->SortByDesc('trimestre.1.points_total.EXAMEN')->values();

   // PLACE TRIMESTRE II
   $trimestre_2 =  collect($palmares)->SortByDesc('trimestre.2.pourcentage')->values();
    $trimestre_2_tj =  collect($palmares)->SortByDesc('trimestre.2.points_total.INTERROGATION')->values();
   $trimestre_2_ex =  collect($palmares)->SortByDesc('trimestre.2.points_total.EXAMEN')->values();

   // PLACE TRIMESTRE III
   $trimestre_3 =  collect($palmares)->SortByDesc('trimestre.3.pourcentage')->values();

   $trimestre_3_tj =  collect($palmares)->SortByDesc('trimestre.3.points_total.INTERROGATION')->values();
   $trimestre_3_ex =  collect($palmares)->SortByDesc('trimestre.3.points_total.EXAMEN')->values();

   // PLACE DES TRAVAUX JOURNALIER
   $data = [];
   // Par defaut on arrage les données par le premier trimestre
   $sorterDBy = $trimestre_1;

   if($trimestre_id == 2)
      $sorterDBy = $trimestre_2;
   //Pour la troisième trimestre
   if($trimestre_id == 3)
      $sorterDBy = $trimestre_3;

   foreach ($sorterDBy as $key => $eleve){
      $e = $eleve->toArray();
      $trim_1 = $trimestre_1->where('id', $eleve->id)->keys();
      $trim_1_tj = $trimestre_1_tj->where('id', $eleve->id)->keys();
      $trim_1_ex = $trimestre_1_ex->where('id', $eleve->id)->keys();
      // Définition des places 
      /*
      Par défaut le tableau commence par zéro on ajouter donc 1 pour trouve la place
      */
      $e['trimestre'][1]['place'] = [
         'tj' => $trim_1_tj->get(0) + 1,
         'ex' => $trim_1_ex->get(0) + 1,
         'total' => $trim_1->get(0) + 1,
      ];

      $trim_2 = $trimestre_2->where('id', $eleve->id)->keys();
      $trim_2_tj = $trimestre_2_tj->where('id', $eleve->id)->keys();
      $trim_2_ex = $trimestre_2_ex->where('id', $eleve->id)->keys();

      $e['trimestre'][2]['place'] = [
         'tj' => $trim_2_tj->get(0) + 1,
         'ex' => $trim_2_ex->get(0) + 1,
         'total' => $trim_2->get(0) + 1,
      ];

      $trim_3 = $trimestre_3->where('id', $eleve->id)->keys();
      $trim_3_tj = $trimestre_3_tj->where('id', $eleve->id)->keys();
      $trim_3_ex = $trimestre_3_ex->where('id', $eleve->id)->keys();

      $e['trimestre'][3]['place'] = [
         'tj' => $trim_3_tj->get(0) + 1,
         'ex' => $trim_3_ex->get(0) + 1,
         'total' => $trim_3->get(0) + 1,
      ];
      
      $data[] = new Eleve($e);
   }
  
   return collect($data);
}

}
