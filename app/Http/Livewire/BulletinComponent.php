<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Section;
use Livewire\Component;

class BulletinComponent extends Component
{
    public $anneScolaire;
    public $classe;
    public $sections;

    public function mount(){
        $this->sections = Section::all();
        $this->anneScolaire = AnneScolaire::latest()->first()->id; 
    }

    public function render()
    {
        $eleve = new Eleve;

        // $points = recuperer_point($eleve_id = 151 ,$cour_id = 16, $trimestre_id = 1, $anne_scolaire_id = $this->anneScolaire , $type_evaluation = 'INTERROGATION' );

        //dump($points);

        $anne_scolaire_id = $this->anneScolaire;
        $classe_id = $this->classe;
        $evaluations = Evaluation::where('anne_scolaire_id', '=', 3)
                    ->where('classe_id','=', 2)->get();

         // dd($evaluations[0]->point_obentue);


        $courseCategories = Classe::find($classe_id) ? Classe::find($classe_id)->courseCategories() : [];

        return view('livewire.bulletin-component',[
            'evaluations' => $evaluations,
            'anne_scolaire_id' => $anne_scolaire_id,
            'courseCategories' => array_reverse($courseCategories),
            'selectClasse' => Classe::find($classe_id),

        ]);
    }
}
