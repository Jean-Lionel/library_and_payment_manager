<?php

namespace App\Http\Livewire;

use App\Models\Eleve;
use App\Models\Paiment;
use App\Models\Section;
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

	public function mount(){
		
		$this->sections = Section::all();

		// dd($this->sections->map->id);
		$this->classes = collect();
	}

    public function render()
    {

    	$q =  '%'.$this->searchKey.'%';
		// $students = Eleve::where('classe_id','=',$this->selectedClasse)
		// ->where(function($query) use($q){
		// 	if($q){
		// 		$query->where('first_name','LIKE','%'.$q.'%')
		// 		->orWhere('last_name','like', '%'.$q.'%')
		// 		; 
		// 	}	

		// })
		// ->get();

	 //   $eleves = Paiment::whereIn('eleve_id',  $students->map->id)
	 //   		git 			->where('type_paiement','MINERVAL')
	 //   					->where('amount' , '>=','7000')
	 //   					->get();

	 //   if($this->type_paiement == 'PAYE'){
	 //   	  $eleves = Paiment::whereIn('eleve_id',  $students->map->id)
	 //   					->where('type_paiement','MINERVAL')
	 //   					->where('amount' , '>=','7000')
	 //   					->get();

	 //   }else if($this->type_paiement == 'NON PAYE'){
	 //   	 $eleves = Paiment::whereIn('eleve_id',  $students->map->id)
	 //   					->where('type_paiement','MINERVAL')
	 //   					->where('amount' , '<','7000')
	 //   					->get();
	 //   }


    	$eleves = Eleve::all();


        return view('livewire.rapport-paiment',

        	[
				// 'eleves'=> $students,
				'eleves' => null
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
