<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Eleve;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $present = 1;
        $request->validate([
            'eleve_id.*' => ['required', 'integer', 'exists:eleves,id'],
            'motif' => 'string|min:3'
        ]);


        // current student
        $class_id = Eleve::find($request->eleve_id[0])->classe_id;

        // recuperer la liste des eleves de la classe du premier eleve
        $eleves =  Eleve::where('classe_id', $class_id )->get();
                // verfication de l'annee scolaire en cours

        foreach ($eleves as $eleve) {
            # code...
            // checking if the student is present
            $is_prensent = in_array($eleve->id ,$request->eleve_id );
            Presence::create([
                'eleve_id' => $eleve->id,
                'user_id' => Auth::user()->id,
                'status_presence' => $is_prensent
            ]);
        }


        return redirect()->route('eleves.index');
    }

}
