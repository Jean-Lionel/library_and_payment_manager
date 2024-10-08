<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public $by_classe = null;
    public function index()
    {

        # Liste de presence pour une classe donnees    a une date donnee

        $listePresence = Presence::
                                    with('eleve')

                                    ->when($this->by_classe, function ($query) {
                                        $query->where('classe_id', $this->by_classe);
                                    })
                                    ->where('created_at', 'like', date('Y-m-d') . '%')
                                    ->get();

        // dd($listePresence );

        return view('presence.index', compact('listePresence'));

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
                'status_presence' => $is_prensent,
                'classe_id' =>  $class_id,
            ]);
        }


        return redirect()->route('eleves.index');
    }

}
