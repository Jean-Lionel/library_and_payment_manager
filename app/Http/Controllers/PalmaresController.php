<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Eleve;
use Illuminate\Http\Request;

class PalmaresController extends Controller
{
   
   public  function getPalmares($annee_scolaire_id, $classe_id, $trimestre){

      $c = Classe::find($classe_id);
      // Liste des cours
      $courses = $c->courses();

      $eleves = Eleve::where('anne_scolaire_id', $annee_scolaire_id)
                        ->where('classe_id',$classe_id)->get();
      foreach ($eleves as $key => $eleve) {
         // code...
         $v = $eleve->getPointTatalObtenue($courses,$trimestre, $annee_scolaire_id);

         dump( $v);
      }       
      
    // CALCULER TOUT LES NOTES
    // CALCULER LE POURCENTAGE
    // ORDONNER LES NOTES
   }
}
