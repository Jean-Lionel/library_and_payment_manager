<?php

namespace App\Http\Controllers;

use App\Models\AnneScolaire;
use App\Models\Classe;
use App\Models\Compte;
use App\Models\Eleve;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        //$eleves = Eleve::all();

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
        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => [
                             'required', 
                             Rule::unique('eleves')
                                    ->where('first_name', $request->first_name)
                                    ->where('classe_id', $request->classe_id)
                            ],
            'classe_id' => 'required'
        ]);
        try {
            DB::beginTransaction();
             $anne_scolaire = AnneScolaire::latest()->firstOrFail();
           //  dd($anne_scolaire);
             $eleve = Eleve::create(array_merge($request->all(), 
                ['anne_scolaire' =>  $anne_scolaire->name , 
                'anne_scolaire_id' => $anne_scolaire->id ]));

             $compte = Compte::create([
                'name' => 'SE-'.$eleve->id,
                'eleve_id' => $eleve->id,
                'montant' => 0,

             ]);

            Session::flash('success', 'Enregistrement réussi  COMPTE NUMERO :  '. $compte->name ?? "");

            DB::commit();
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();  
        }

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

    public function SaveList(Request $request){

        $data = $request->all();

        try {

           
             $anne_scolaire = AnneScolaire::latest()->firstOrFail();

             foreach ($data['data'] as $key => $value) {
                   $result =  Validator::validate($value, [
                        'first_name' => 'required|min:2',
                        'last_name' => ['required'],
                        'classe_id' => 'required',
                        'anne_scolaire_id' =>  $anne_scolaire->id,
                        'anne_scolaire' =>  $anne_scolaire->name,
                    
                     ]);

                   try {
                      DB::beginTransaction();

                       $eleve = Eleve::create($result);
                         $compte = Compte::create([
                            'name' => 'SE-'.$eleve->id,
                            'eleve_id' => $eleve->id,
                            'montant' => 0,

                         ]);

                      DB::commit();
                       
                   } catch (\Exception $e) {

                    dd($e->getMessage());
                       
                   }
                    
              } 
        } catch (\Exception $e) {
           

            dd($e->getMessage());
            
        }

       

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
