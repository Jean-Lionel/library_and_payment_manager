<?php

namespace App\Http\Controllers;

use App\Models\Eleve;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    //
    public function effectif(){

        return view('rapport.effectif');
    }

    public  function getEffectifs($anne_scolaire_id){

        $eleves = Eleve::where('anne_scolaire_id', $anne_scolaire_id)
                        ->get();

        dd($eleves);
    }
}
