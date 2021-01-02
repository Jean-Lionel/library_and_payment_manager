<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Compte;
use App\Models\Paiment;
use Livewire\Component;

class PaiementLivewire extends Component
{
	private $paiements;
	public $showFormulaire = false ;
	public $compteName;
	public $eleve;
	public $anneScolaire;


	public function mount(){
		$this->paiements = Paiment::sortable()->latest()->paginate();
		$this->anneScolaire = AnneScolaire::latest()->take(1)->first();
	}


	public function render()
	{
		return view('livewire.paiement-livewire',
			[
				'paiements' => $this->paiements
			]

		);
	}

	public function showForm(){
		$this->showFormulaire = !$this->showFormulaire;
	}

	public function updatedCompteName($compte){

		$compte = Compte::where('name','LIKE','%'.$compte)->first();

		if($compte){
			$this->eleve = $compte->eleve;
		}else{
			$this->eleve = null;
		}
	}

	public function savePaiement(){
		dump("je suis cool");

	}
}
