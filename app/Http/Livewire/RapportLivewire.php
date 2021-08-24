<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Order;
use App\Models\Paiment;
use App\Models\Section;
use Livewire\Component;
use Livewire\WithPagination;

class RapportLivewire extends Component
{ 
    use WithPagination;

    protected $paginationTheme ='bootstrap';

    public function mount(){
        
    }

    public function render()
    { 	
    	$contribution = Paiment::where('type_paiement','=','CONTRIBUTION')->sum('amount');
    	$minerval  = Paiment::where('type_paiement','=','MINERVAL')->sum('amount'); 

        $classes = Classe::all()->map->name;
        // $nomsClasse = [];
         $nombre_eleves = [];

         foreach(Classe::all() as $c){
            $nombre_eleves[] = $c->nombre_eleves();
         }
        $vente = Order::all()->sum('montant');

        return view('livewire.rapport-livewire',[
        	'contribution' => $contribution,
        	'minerval' => $minerval,
            'vente' => $vente,
            'classes' => $classes,
            'nombre_eleves' => $nombre_eleves,
        ]);
    }


  

}
