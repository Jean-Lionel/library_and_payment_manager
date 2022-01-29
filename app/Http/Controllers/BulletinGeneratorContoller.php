<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PalmaresController;
use Illuminate\Http\Request;

class BulletinGeneratorContoller extends Controller
{
   
   public function bulletin($id){
      $classe_id = $id;
      $anne_scolaire_id = \Request::get('x');
      
      $resultat = PalmaresController::getNote($anne_scolaire_id, $classe_id, 1);

      dd( $resultat);
   }
}
