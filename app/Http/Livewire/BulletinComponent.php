<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Evaluation;
use App\Models\Section;
use Livewire\Component;

class BulletinComponent extends Component
{
    public $anneScolaire = 3;
    public $classe;
    public $sections;

    public function mount(){
        $this->sections = Section::all();
    }

    public function render()
    {
        $anne_scolaire_id = $this->anneScolaire;
        $classe_id = $this->classe;
        $evaluations = Evaluation::where('anne_scolaire_id', '=', $anne_scolaire_id)
                    ->where('classe_id','=', $classe_id)->get();


        $courseCategories = Classe::find($classe_id) ? Classe::find($classe_id)->courseCategories() : [];

        return view('livewire.bulletin-component',[
            'evaluations' => $evaluations,
            'courseCategories' => array_reverse($courseCategories),
            'selectClasse' => Classe::find($classe_id),

        ]);
    }
}
