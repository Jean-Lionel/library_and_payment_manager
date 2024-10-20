<?php
namespace App\Http\Livewire;

use App\Models\Eleve;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class EleveLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme ='bootstrap';
	private $eleves;
    public $sections;
    public $classes;
    public $searchKey ="";
    public $selectedSection=null;
    public $selectedClasse=null;

	public function mount(){
		
        $this->sections = Section::all();
        $this->classes = collect();
	}

    public function updated(){
        //$this->eleves = Eleve::paginate();
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

        return view('livewire.eleve-livewire',
        	[
        		'eleves'=>  $eleves

        	]
    );
    }


    public function updatedSelectedSection($section_id)
    {
        $section = Section::find($section_id);
        $this->classes = $section->classes ?? collect();
        
        $this->render();

    }

   
   
}
