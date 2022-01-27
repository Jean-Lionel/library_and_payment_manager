<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Trimestre;
use Livewire\Component;

class PalmaresHeader extends Component
{
    public $anne_scolaire_id;
    public $section_id;
    public $classe_id;
    public $trimestre;
    public $classes = [];
    protected $queryString = ['anne_scolaire_id' => ['as' => 's']];

    public function render()
    {
         $annee_scolaires = AnneScolaire::latest()->get();
         $trimestres = Trimestre::all();
         $sections = Section::all();
        return view('livewire.palmares-header',[
            'annee_scolaires' => $annee_scolaires,
            'sections' => $sections,
            'trimestres' => $trimestres,

        ]);
    }

    public function updatedSectionId(){

        $this->classes = Classe::where('section_id',$this->section_id)->get();
    }

    public function searchParmales(){
        return redirect()->route('get_palmares',[
            'annee_scolaire_id' =>  $this->anne_scolaire_id,
            'classe_id' =>  $this->classe_id,
            'trimestre' =>  $this->trimestre
        ]);
    }
}
