<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Eleve;
use Illuminate\Http\Request;

class PalmaresController extends Controller
{
   
   public  function getPalmares($annee_scolaire_id, $classe_id, $trimestre){

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

         $eleve->points = $v;
         $eleve->poucentage = getPourcentage($v, $max_total['total']) ;
         $palmares[] = $eleve;
        
      } 

      $palmares = collect($palmares)->sortByDesc('points');

      return view('bulletin.palmares', compact('palmares'));   
      
    // CALCULER TOUT LES NOTES
    // CALCULER LE POURCENTAGE
    // ORDONNER LES NOTES
   }
}
