<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Compte;
use App\Models\Eleve;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eleves = Eleve::paginate();

        //dd($eleves);

        return view('eleves.eleve', compact('eleves'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = \Request::get('id');
        $classe = Classe::find( $id );
       return view('eleves.create',compact('classe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'classe_id' => 'required',
        ]);

        $compte = null;

       

        DB::transaction(function() use ($request, $compte) {
             $eleve = Eleve::create($request->all());
             $compte = Compte::create([
                'name' => 'SE-'.$eleve->id,
                'eleve_id' => $eleve->id,
                'montant' => 0,

             ]);

            Session::flash('success', 'Enregistrement réussi  COMPTE NUMERO :  '. $compte->name ?? "");

        });

      



        
  

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classe  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $classe)
    {
        dd($classe->eleves());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function edit($eleve)
    {
        $eleve = Eleve::find($eleve);

        $classe = $eleve->classe;

        return view('eleves.edit', compact('eleve','classe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Eleve $eleve)
    {
        //

        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'classe_id' => 'required',
        ]);

        $eleve->update($request->all());

        Session::flash('success', 'Enregistrement réussi');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function destroy($eleve)
    {
        //
        Eleve::find($eleve)->delete();

        return back();
    }
}
