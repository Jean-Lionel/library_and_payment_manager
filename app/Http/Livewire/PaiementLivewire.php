<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Compte;
use App\Models\Paiment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PaiementLivewire extends Component
{
	use WithPagination;

	protected $paginationTheme ='bootstrap';

	private $paiements;
	public $showFormulaire = false ;
	public $compteName;
	public $eleve;

	//Les attributs 



	public $montant;
	public $anneScolaire;
	public $bordereau;
	public $trimestre;
	public $type_paiement;

	public $facture;

	public $showFacture = false;

	public function mount()
	{
		 $this->paiements = Paiment::sortable()->latest()->paginate(20);
		
	}

	
	public function render()
	{
		$this->paiements = Paiment::sortable()->latest()->paginate(20);
		$this->anneScolaire = AnneScolaire::latest()->take(1)->first();
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


	public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->paiements = Paiment::sortable()->latest()->paginate();
        $this->render();
    }

	 protected $rules = [
        'montant' => 'required|numeric|min:0',
        'bordereau' => 'required|min:2',
        'trimestre' => 'required|min:2',
        'compteName' => 'required',
        'type_paiement' => 'required',
        
    ];

	public function savePaiement(){
		$validatedData = $this->validate();

		try {
			DB::beginTransaction();

			Paiment::create([
				'amount' => $this->montant,
				'bordereau' => $this->bordereau,
				'compte_id' => $this->eleve->compte->id,
				'compte_name' => $this->eleve->compte->name,
				'eleve_id' => $this->eleve->id,
				'user_id' => 1,
				'type_paiement' => $this->type_paiement,
				'trimestre' => $this->trimestre,
				'annee_scolaire' => $this->anneScolaire->name,
			]);

			$compte =  $this->eleve->compte;

			$compte->montant += abs($this->montant);

			$compte->save();
			DB::commit();

			$this->resetInput();
			
		} catch (\Exception $e) {

			DB::rollback();

			dump($e);
			
		}


	}


	private function resetInput(){
		 $this->eleve = null;
		 $this->montant = null;
		 $this->bordereau = null;
		 $this->compteName = null;
	}

	public function closeBill(){
		$this->showFacture = false;
	}

	public function printBill($id){
		$this->facture = Paiment::find($id);
		$this->showFacture= true;
	}

	
}
