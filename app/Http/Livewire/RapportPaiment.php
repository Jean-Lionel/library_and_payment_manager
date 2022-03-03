<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Classe;
use App\Models\Configuration;
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
	public $annee_scolaire;
	public $minMontant = 1000;
	public $anneScolaire;
	public $trimestre = "PREMIER TRIMESTRE";
    public $category_paiement = "MINERVAL";

	/**
	 * 
	 */
	public function mount(){
		
		$this->sections = Section::all();

		// dd($this->sections->map->id);
		$this->classes = collect();
		$this->anneScolaire = AnneScolaire::latest()->get();
		$this->annee_scolaire = AnneScolaire::latest()->first()->name ?? "";

	    $this->eleve = new Eleve;
	    $this->classe = new Classe;
	}

    public function render()
    {

    	$q =  '%'.$this->searchKey.'%';
		$class_id = $this->classes->map->id ?? 1;
		$type_paiement =  $this->type_paiement;
        $annee_scolaire =  $this->annee_scolaire;
        $trimestre =  $this->trimestre;
        $minMontant =  $this->minMontant;
        $category_paiement =  $this->category_paiement; // MINERVAL OU CONTRIBUTION

        

		// dump($type_paiement);
		if($this->selectedClasse)
			$class_id = [$this->selectedClasse];


    	$eleves = DB::table('eleves')
    				->leftJoin('paiments', function($join) use( $annee_scolaire,  $trimestre, $category_paiement){
    					$join->on('eleves.id', '=', 'paiments.eleve_id')

    					->where('paiments.type_paiement','=',$category_paiement)
    					->where('paiments.annee_scolaire', '=', $annee_scolaire)
    					 ->where('paiments.trimestre','=', $trimestre)

    					;

    					})->whereIn('eleves.classe_id' ,$class_id)
    					  ->where(function($query) use ($type_paiement, $minMontant){

    					  	if($type_paiement == 'PAYE'){
    					  		$query->where('paiments.amount', '>=',  $minMontant);
    					  	}

    					  	if($type_paiement == 'NON PAYE')
    					  	{
    					  		 $query->where('paiments.amount', '<',  $minMontant)
    					  		 		->orWhere('paiments.amount', '=', NULL);
    					  	}
    					  	
    					  })
    				  	 ->where(function($query) use ($q){
    				  		$query->where('eleves.first_name', 'LIKE', $q)
    				  		  ->orWhere('eleves.last_name', 'LIKE', $q);
    				 })
    				  	 ->where('eleves.anne_scolaire','=',$this->annee_scolaire)
    				  	 // ->where('paiments.annee_scolaire', '=', $this->annee_scolaire)

    				  	 ->get();

    	$configuration = Configuration::latest()->first();


        return view('livewire.rapport-paiment',

        	[
				// 'eleves'=> $students,
				'eleves' => $eleves,
				'configuration' => $configuration
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
