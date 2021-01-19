<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Order;
use App\Models\Paiment;
use App\Models\Section;
use Livewire\Component;

class RapportLivewire extends Component
{ 


    public function mount(){
        
    }



    public function render()
    { 	
    	$contribution = Paiment::where('type_paiement','=','CONTRIBUTION')->sum('amount');
    	$minerval  = Paiment::where('type_paiement','=','MINERVAL')->sum('amount'); 

        $vente = Order::all()->sum('montant');

        return view('livewire.rapport-livewire',[
        	'contribution' => $contribution,
        	'minerval' => $minerval,
            'vente' => $vente,
        ]);
    }


  

}
