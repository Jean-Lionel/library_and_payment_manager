<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PalmaresController;
use App\Models\Classe;
use App\Models\Eleve;
use Illuminate\Http\Request;
use PDF;

class BulletinGeneratorContoller extends Controller
{

   public function __construct(){
      //$eleves = Eleve::where('classe_id',2)->get();
   }
   
   public function bulletin($id){
      $classe_id = $id;
      $anne_scolaire_id = \Request::get('x');
      $trimestre_id = \Request::get('t');

      $data = PalmaresController::getNoteAllTrimestre($anne_scolaire_id, $classe_id,$trimestre_id);

      $section = Classe::findOrFail($classe_id)->section;

      if (strcmp(strtoupper($section->name),'FONDAMENTALE') == 0) {
         // code...
          /*$pdf = PDF::loadView('bulletin.fondamental',compact('data'));

          $pdf->setPaper("A3","landscape");

          return $pdf->download('hello.pdf');*/

          return view("bulletin.fondamental", compact('data'));
      }else{
         return view("bulletin.post-fondamental", compact('data'));
      }

      /*$data = PalmaresController::getNote($anne_scolaire_id, $classe_id, 1);
      $this->getDataSum($data);
      return view("bulletin.fondamental", compact('data'));*/
   }

   private function getDataSum($data){
      
      
   }
}
