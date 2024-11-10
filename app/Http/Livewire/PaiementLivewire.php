<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Compte;
use App\Models\Paiment;
use App\Models\Section;
use App\Models\EcheancePaiement;
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
	public $search;

	//Les attributs

	public $montant;
	public $anneScolaire;
	public $bordereau;
	public $trimestre;
	public $type_paiement = [];
	public $number_letter  = "";

	public $facture;
	public $ordre=false;
	public $showFacture = false;
    public $echeanceToggle = false;

    public $section_id;
    public $nom_echeance;
    public $startDate;
    public $endDate;
    public $amount;


	public function mount()
	{
		 // $this->paiements = Paiment::sortable()->latest()->paginate(20);

	}

	public function showEnOrdre()
	{
		$this->ordre=!$this->ordre;
		$this->showFormulaire = false;
	}

	public function render()
	{
		$s = $this->search;
        $sections = Section::all();
		$this->paiements = Paiment::with('eleve')
        ->where(function($q) use ($s){
			if($s != ""){
				// $q->where('eleve_id', $s);
                $q->where('compte_name', 'like', '%'. $s .'%');
                $q->orwhere('type_paiement', 'like', '%'. $s .'%');
                $q->orwhere('bordereau', 'like', '%'. $s .'%');
			}
		})->sortable()->latest()->paginate(10);
		$this->anneScolaire = AnneScolaire::latest()->take(1)->first();


		return view('livewire.paiement-livewire',
		[
			'paiements' => $this->paiements,
            'sections' => $sections
			]

		);
	}

	public function showForm(){
		$this->showFormulaire = !$this->showFormulaire;
		$this->ordre=false;
	}

    public function openEcheance()
    {
        $this->echeanceToggle =! $this->echeanceToggle;
    }

    public function saveEcheance()
    {
        // dd('good');
        EcheancePaiement::create([
            'section_id' => $this->section_id,
            'nom_echeance' => $this->nom_echeance,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'amount' => $this->amount,
            'user_id' => auth()->user()->id,
            'ecole_id' => auth()->user()->ecole_id
        ]);
        $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);
		$this->resetInput();
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
        // $this->validateOnly($propertyName);
        // // $this->paiements = Paiment::sortable()->latest()->paginate();
        // $this->render();
    }
 // La fonction pour fixer l'erreur de recherche dans la deuxieme page de la pagination
    public function updating($key): void
    {
        if ($key === 'search') {
            $this->resetPage();
        }
    }


	protected $rules = [
        'montant' => 'required',
        // 'bordereau' => 'required|min:2',
        'trimestre' => 'required|min:2',
        'compteName' => 'required',
        'type_paiement.*' => 'required',

    ];

	public function savePaiement(){

		if($this->type_paiement == 'MINERVAL'){
			$this->rules['montant'] =  [
        	'required',
        	//'size:7000',
        	'numeric'];
		}


		$validatedData = $this->validate();
		try {
			DB::beginTransaction();
            $number = mt_rand(1000000000,9999999999);
            $this->bordereau = $number;

			Paiment::create([
				'amount' => $this->montant,
				'bordereau' => $this->bordereau,
				'compte_id' => $this->eleve->compte->id,
				'compte_name' => $this->eleve->compte->name,
				'eleve_id' => $this->eleve->id,
				'user_id' => 1,
				'type_paiement' => json_encode($this->type_paiement),
				'trimestre' => $this->trimestre,
				'annee_scolaire' => $this->anneScolaire->name,
			]);

			$compte =  $this->eleve->compte;

			$compte->montant += abs($this->montant);

			$compte->save();
			DB::commit();
            $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);
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

	public function printBill($id, $number_letter = null){

		$this->facture = Paiment::find($id);
		$this->showFacture= true;
		$this->number_letter = $number_letter . " FBU";
	}


}
