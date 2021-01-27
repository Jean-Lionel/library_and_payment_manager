<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Paiment;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RapportPaiment extends Component
{

	private $eleves;
	public $sections;
	public $classes;
	public $searchKey ="";
	public $selectedSection=null;
	public $selectedClasse=null;
	public $type_paiement ;
	public $eleve;
	public $classe;

	/**
	 * 
	 */
	public function mount(){
		
		$this->sections = Section::all();

		// dd($this->sections->map->id);
		$this->classes = collect();

	    $this->eleve = new Eleve;
	    $this->classe = new Classe;
	}

    public function render()
    {

    	$q =  '%'.$this->searchKey.'%';
		$class_id = $this->classes->map->id;

		if($this->selectedClasse)
			$class_id = [$this->selectedClasse];


    	$eleves = DB::table('eleves')
    				->leftJoin('paiments', function($join){
    					$join->on('eleves.id', '=', 'paiments.eleve_id')
    						 ->where('paiments.type_paiement','=','MINERVAL');
    				})->whereIn('eleves.classe_id' ,$class_id)
    				  ->where(function($query) use ($q){
    				  	$query->where('eleves.first_name', 'LIKE', $q)
    				  		  ->orWhere('eleves.last_name', 'LIKE', $q);
    				 })->get();


        return view('livewire.rapport-paiment',

        	[
				// 'eleves'=> $students,
				'eleves' => $eleves
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
