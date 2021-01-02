<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Section;
use Livewire\Component;

class EleveLivewire extends Component
{
	private $eleves;
    public $sections;
    public $classes;
    public $selectedSection=null;
    public $selectedClasse="";

	public function mount(){
		$this->eleves = Eleve::paginate();
        $this->sections = Section::all();
           $this->classes = collect();
	}

    public function updated(){
        $this->eleves = Eleve::paginate();
    }

    public function render()
    {

        return view('livewire.eleve-livewire',
        	[
        		'eleves'=> $this->eleves

        	]
    );
    }


    public function updatedSelectedSection($section_id)
    {
        $section = Section::find($section_id);
        $this->classes = $section->classes ?? collect();
        // $this->eleves = Eleve::paginate();
        $this->render();

    }

    public function updatedSelectedClasse($class_id)
    {
        $this->eleves = Classe::find($class_id)->eleves ?? collect();

         $this->render();

    }
}
