<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horaire;
use Illuminate\Support\Facades\Auth;

class HoraireController extends Controller
{
    public function index()
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
       foreach (json_decode($request->t) as $horaire) {
           Horaire::create([
               'jour' =>  $horaire->jour,
               'classe_id' => $horaire->classe,
               'heure' => $horaire->heure,
               'intervalle' => $horaire->intervalle,
               'cours' => $horaire->cours,
               'enseignant_id' => $horaire->teacher,
               'user_id' => Auth::user()->id,
           ]);
       }
        return back();
    }
}
