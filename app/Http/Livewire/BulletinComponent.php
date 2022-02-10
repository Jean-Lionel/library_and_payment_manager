<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Section;
use App\Models\Trimestre;
use Livewire\Component;

class BulletinComponent extends Component
{
    public $anneScolaire;
    public $classe;
    public $anne_scolaire_id;
    public $trimestre_id;
    public $sections;

    public function mount(){
        $this->sections = Section::all();
        $this->anne_scolaire_id = AnneScolaire::latest()->first()->id; 
        $this->trimestre_id = 1; 
    }

    public function render()
    {
        $eleve = new Eleve;

        // $points = recuperer_point($eleve_id = 151 ,$cour_id = 16, $trimestre_id = 1, $anne_scolaire_id = $this->anneScolaire , $type_evaluation = 'INTERROGATION' );
        //dump($points);
        $annee_scolaires =  AnneScolaire::latest()->paginate();
        $trimestres =  Trimestre::latest()->get();
        $classe_id = $this->classe;
        $evaluations = Evaluation::where('anne_scolaire_id', '=', 3)
                    ->where('classe_id','=', 2)->get();

         // dd($evaluations[0]->point_obentue);


        $courseCategories = Classe::find($classe_id) ? Classe::find($classe_id)->courseCategories() : [];

        return view('livewire.bulletin-component',[
            'evaluations' => $evaluations,
            'trimestres' => $trimestres,
            'courseCategories' => array_reverse($courseCategories),
            'selectClasse' => Classe::find($classe_id),
            'annee_scolaires' => $annee_scolaires,

        ]);
    }
}
