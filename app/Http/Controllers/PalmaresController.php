<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;

class PalmaresController extends Controller
{
   
   public function getPalmares($anne_scolaire_id, $classe_id, $trimestre){

      $eleves = Eleve::where('anne_scolaire_id', $anne_scolaire_id)
                        ->where('classe_id',$classe_id)->get();
      foreach ($eleves as $key => $eleve) {
                // code...
         $eleve->getPointTatalObtenue();
      }       
      
    // CALCULER TOUT LES NOTES
    // CALCULER LE POURCENTAGE
    // ORDONNER LES NOTES
   }
}
