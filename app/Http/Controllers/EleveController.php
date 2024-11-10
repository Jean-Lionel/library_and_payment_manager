<?php

namespace App\Http\Controllers;

use App\Models\AnneScolaire;
use App\Models\Burundizipcode;
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


    public function apiEleve(){
        $eleves = Eleve::paginate();

        return  $eleves;
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
            'classe_id' => 'required',
            'date_naissance' => 'date',
            'sexe' => 'required',
            'address' => 'required',
            'image_eleve' => 'image|mimes:jpg,jpeg,png|max:1024',
        ]);
        $fileName = time().'.'.$request->image_eleve->extension();

        $request->image_eleve->move(public_path('uploads/eleve'), $fileName);
        try {
            DB::beginTransaction();
             $anne_scolaire = AnneScolaire::latest()->firstOrFail();

             $number = mt_rand(10000,99999);
            $random = $number;
           //  dd($anne_scolaire);
             $eleve = Eleve::create(
                [
                'anne_scolaire' =>  $anne_scolaire->name,
                'anne_scolaire_id' => $anne_scolaire->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'classe_id' => $request->classe_id,
                'date_naissance' => $request->date_naissance,
                'sexe' => $request->sexe,
                'address' => $request->address,
                'image_eleve' => $fileName,
                ]);
             $compte = Compte::create([
                'name' => 'SE-'.$eleve->id,
                'eleve_id' => $eleve->id,
                'montant' => 0,
               'account_number' => $random

             ]);
             $notification = array(
                'message' => 'Enregistrement effecté avec succes',
                'alert-type' => 'success'
            );
            // Session::flash('success', 'Enregistrement réussi  COMPTE NUMERO :  '. $compte->name ?? "");
            return redirect()->back()->with($notification);
            DB::commit();

        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Opération échouée',
                'alert-type' => 'error'
            );
            // Session::flash('success', 'Enregistrement réussi  COMPTE NUMERO :  '. $compte->name ?? "");
            return redirect()->back()->with($notification);
            dd($e->getMessage());
            DB::rollback();
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Eleve  $eleve
     * @return \Illuminate\Http\Response
     */
    public function show(Eleve $eleve)
    {
        //dd($classe->eleves());
        return $eleve;
    }

    public function SaveList(Request $request){
        $data = $request->all();
        try {
             DB::beginTransaction();
             $anne_scolaire = AnneScolaire::latest()->firstOrFail();
             foreach ($data['data'] as $key => $value) {

                   $result = array_merge($value, [
                        'anne_scolaire_id' =>  $anne_scolaire->id,
                        'anne_scolaire' =>  $anne_scolaire->name,

                   ]);

                    $eleve = Eleve::create($result);
                    $compte = Compte::create([
                            'name' => 'SE-'.$eleve->id,
                            'eleve_id' => $eleve->id,
                            'montant' => 0,
                     ]);

              }

            DB::commit();
        } catch (\Exception $e) {

           return $e->getMessage();

        }

       return $data;

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
    public function update(Request $request,$id)
    {
        //

        $eleve = Eleve::findOrFail($id);

        $request->validate([
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
            'classe_id' => 'required',
            'sexe' => 'required',
        ]);

        $eleve->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'classe_id' => $request->classe_id,
                'date_naissance' => $request->date_naissance,
                'sexe' => $request->sexe,
                'address' => $request->address,

        ]);

        Session::flash('success', 'Modification réussi');

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
