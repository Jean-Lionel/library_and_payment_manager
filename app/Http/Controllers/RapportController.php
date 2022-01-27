<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use App\Models\Level;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    //
    public function effectif(){

        return view('rapport.effectif');
    }

    public  function getEffectifs($anne_scolaire_id){

        $objects = Level::all()->groupBy('section_id');
        $classes = [];
        $levels = [];

        foreach ($objects as $key => $niveau) {
          
            foreach ($niveau as $k => $v) {
                // code...
                  $levels[] = $v->getStudentByAnneScolaireId($anne_scolaire_id);
              foreach ($v->classes as $key => $value) {
                $classes[] = $value->getEffectifParClasse($anne_scolaire_id);
              }
            }
        }

         return view('rapport.effectif_doc', compact('classes','levels'));
       
    }
}
