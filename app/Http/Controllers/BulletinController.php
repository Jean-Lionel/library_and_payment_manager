<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBulletinRequest;
use App\Http\Requests\UpdateBulletinRequest;
use App\Models\AnneScolaire;
use App\Models\Bulletin;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Trimestre;
use Illuminate\Http\Request;


class BulletinController extends Controller
{
    // id = classe_id
    // x = annee_scolaire_id
    public function bulletin($id){
        $classe_id = $id;
        $anne_scolaire_id = \Request::get('x');

        $anneScolaire = AnneScolaire::find($anne_scolaire_id);

        $selectClasse = Classe::find($classe_id );

           $courseCategories = Classe::find($classe_id) ? Classe::find($classe_id)->courseCategories() : [];
        return view('bulletin.show', 

            compact('anneScolaire','anne_scolaire_id','selectClasse','courseCategories'));
    }

    public function liste_point(){
        //CLASSE
        //COURS
        //TRIMESTRE
        // ANNEE SCOLAIRE

        return view('bulletin.liste_point');
    }

    public function notes(){

        $sections =  Section::all();
        $trimestres =  Trimestre::all();
        $select_section = \Request::get('section') ?? 0;
        $select_classe = \Request::get('classe_id') ?? 0;

        $classes = Classe::where('section_id',$select_section)->get() ?? [];
       
        $choosedClasse = Classe::find($select_classe);
        $annee_scolaires = AnneScolaire::latest()->get();
        return view('bulletin.notes', compact('sections', 'select_section', 'trimestres', 'classes', 'choosedClasse','annee_scolaires', 'select_classe'));
    }


    public function get_notes(Request $request){

      //"section_id" => "1"
      // "classe_id" => "1"
      // "cours_id" => "1"
      // "trimestre" => "2"
      // "annee_scolaire" => "1"

        dd($request->all());
    }
}
