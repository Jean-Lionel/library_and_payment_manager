<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Order;
use App\Models\Paiment;
use App\Models\Section;
use Livewire\Component;

class RapportLivewire extends Component
{ 
	public $sumTotal;
    public $sections;
    public $classes;
    public $selectedSection = null;


	public function mount(){
		$this->sumTotal = 0;
        $this->sections = Section::all();
        $this->classes = collect();
	}
    public function render()
    { 	
    	$contribution = Paiment::where('type_paiement','=','CONTRIBUTION')->sum('amount');
    	$minerval  = Paiment::where('type_paiement','=','MINERVAL')->sum('amount'); 
// Textes complets id  montant
        $vente = Order::all()->sum('montant');
        return view('livewire.rapport-livewire',[
        	'contribution' => $contribution,
        	'minerval' => $minerval,
            'vente' => $vente,
        ]);
    }

    public function updatedSelectedSection(){
        dd("je suis cool");

    }

    // public function updatedSelectedSection($section_id)
    // {
    //     dd($section_id);
    //     $section = Section::find($section_id);
    //     $this->classes = $section->classes;
    //     // $this->eleves = Eleve::paginate();
    //     $this->render();

    // }


}
