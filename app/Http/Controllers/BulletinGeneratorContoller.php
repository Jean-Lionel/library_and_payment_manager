<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PalmaresController;
use App\Models\Eleve;
use Illuminate\Http\Request;

class BulletinGeneratorContoller extends Controller
{

   public function __construct(){
      //$eleves = Eleve::where('classe_id',2)->get();
   }
   
   public function bulletin($id){
      $classe_id = $id;
      $anne_scolaire_id = \Request::get('x');

      $data = PalmaresController::getNoteAllTrimestre($anne_scolaire_id, $classe_id);

      return view("bulletin.bulletin", compact('data'));

      /*$data = PalmaresController::getNote($anne_scolaire_id, $classe_id, 1);
      $this->getDataSum($data);
      return view("bulletin.fondamental", compact('data'));*/
   }

   private function getDataSum($data){
      
      
   }
}
