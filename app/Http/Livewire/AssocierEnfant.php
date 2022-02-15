<?php

namespace App\Http\Livewire;

use App\Models\Eleve;
use App\Models\Section;
use Livewire\Component;

class AssocierEnfant extends Component
{
    public $sections;
    public $classes;
    public $searchKey ="";
    public $selectedSection=null;
    public $selectedClasse=null;

    public $parent;
    public function mount($parent)
    {
        // code...
       $this->parent = $parent;
       $this->sections = Section::all();
       $this->classes = collect();
    }
    public function render()
    {
        $q = $this->searchKey;
        $eleves = Eleve::where('classe_id','=',$this->selectedClasse)
                        ->where(function($query) use($q){
                            if($q){
                                $query->where('first_name','LIKE','%'.$q.'%')
                                      ->orWhere('last_name','like', '%'.$q.'%')
                                   ; 
                            } 

                        })
                        ->paginate(4);

        return view('livewire.associer-enfant',[
            'eleves' => $eleves
        ]);
    }

    public function updatedSelectedSection($section_id)
    {
        $section = Section::find($section_id);
        $this->classes = $section->classes ?? collect();

    }

}
