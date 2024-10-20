<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Discipline;
use App\Models\Eleve;
use App\Models\Derangement;
use App\Models\Trouble;
use App\Models\Retard;
use App\Models\Impoli;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Tricherie;
use Livewire\WithPagination;

class DesciplineComponent extends Component
{
    use WithPagination;
    private $eleves;
    public $sections;
    public $classes;
    public $searchKey ="";
    public $selectedSection=null;
    public $selectedClasse=null;
    public $retard;
    public $derangement;
    public $impolitesse;
    public $tricherie;
    public $eleve_id;

    public $motif;
    public $duree;
    public $elevebyId;

    // protected $listeners = ['Retard'];
    public function mount(){

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
                        ->paginate();
        return view('livewire.descipline-component',
                        [
                            'eleves' => $eleves
                        ]
    )->layout('layouts.base');
    }

    public function Retard($id)
    {
        Retard::create([
            'eleve_id' => $id
        ]);
       return back();
    }

    public function getEleveById(int $id)
    {
        dd($id);
        // $eleveid = Eleve::find($id);
        // if ($eleveid) {
        //     $this->elevebyId = $eleveid->id;
        // } else {
        //     return redirect()->to('discipline');
        // }

    }
    public function exclure($id)
    {
        Exclusion::create([
            'eleve_id' => $id,
            'motif' => $this->motif,
            'duree' => $this->duree
        ]);
    }
    public function Derangement($id)
    {
        Derangement::create([
            'eleve_id' => $id
        ]);
       return back();
    }

    public function Trouble($id)
    {
        Trouble::create([
            'eleve_id' => $id
        ]);
       return back();
    }

    public function Tricherie($id)
    {
        Tricherie::create([
            'eleve_id' => $id
        ]);
    }

    public function Impoli($id)
    {
        Impoli::create([
            'eleve_id' => $id
        ]);
       return back();
    }

    public function updatedSelectedSection($section_id)
    {
        $section = Section::find($section_id);
        $this->classes = $section->classes ?? collect();

        $this->render();

    }
}
