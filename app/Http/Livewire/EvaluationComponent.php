<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Classe;
use App\Models\Cour;
use App\Models\Evaluation;
use App\Models\Trimestre;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class EvaluationComponent extends Component
{
	use WithPagination;
	protected $paginationTheme = 'bootstrap';

	public $ponderation;
	public $trimestre;
	public $type_evaluation;
	public $courId;
	public $classeId=null;
	public $anne_scolaire_id;
	public $description;
	public $date_evaluation ;
	public $classes;
	public $start_date;
	public $cours;
	public $trimestres;
	public $showForm = false;
	public $identification = null;
	public $currentAnneScolaire ;
	public $professeur;
	public $search;

	public function mount(){
		if(auth()->user()->isProfesseur()){
			 $this->professeur = auth()->user()->professeur;
			 $levels = $this->professeur->cours->map->level_id;

			$this->classes = Classe::whereIn('level_id',$levels)->get();
			$this->cours = [];
		}else{
			$this->classes = Classe::all();
			$this->cours = [];
		}
		
		$this->start_date = Carbon::now()->subDays(30);
		$this->trimestres = Trimestre::all();
		$this->trimestre = Trimestre::current();
		$this->currentAnneScolaire =  AnneScolaire::latest()->first();
	}

	public function render()
    {
    	$s = $this->search;

    	 if(auth()->user()->isProfesseur()){
           //$prof = auth()->user()->professeur;
            $evaluations = Evaluation::where(function($query) use ($s){

            	if(!empty($s)){
            		$query->where("ponderation",'=',$s)
            					->orWhere("type_evaluation","like","%".$s."%")
            					->orWhere("date_evaluation","like","%".$s."%")
            					->orWhere("cour_id","=", $s);
            	};

            })->where('user_id', auth()->user()->id)->latest()->paginate(10);
        }else{
          $evaluations = Evaluation::where(function($query) use($s){
          	if(!empty($s)){
            		$query->where("ponderation",'=',$s)
            					->orWhere("type_evaluation","like","%".$s."%")
            					->orWhere("date_evaluation","like","%".$s."%")
            					->orWhere("cour_id","=", $s);
            	};
          })->latest()->paginate(10);
        }


        return view('livewire.evaluation-component',[
        	'evaluations' => $evaluations
        ]);
    }

    public function updatedClasseId($classe_id){
    	if($this->professeur){
    		$classe = Classe::find($classe_id);
    		$this->cours = Cour::where('level_id',$classe->level_id)
    							->where('professeur_id',$this->professeur->id)->get();
    	}else{
    		$this->cours = Classe::find($classe_id)->courses() ?? [];
    	}
    }
    public function toogleForm(){
    	$this->showForm = true;
    }

    protected $rules = [
		"ponderation" => "numeric|required|min:0",
		"courId" => "required",
		"classeId" => "required",
		// "date_evaluation" => "required|date|min:now()",
		"type_evaluation" => "required",
		'start_date'    => 'required|date',
    	'date_evaluation'      => 'required|date|after_or_equal:start_date',

	];

	public function saveEvalution(){
		$this->validate();
		$data = [
			"ponderation" => $this->ponderation,
			"trimestre" => $this->trimestre->id,
			"cour_id" => $this->courId,
			"classe_id" => $this->classeId,
			"date_evaluation" => $this->date_evaluation,
			"type_evaluation" => $this->type_evaluation,
			"anne_scolaire_id" => $this->currentAnneScolaire->id,
		];

		if($this->identification){
			Evaluation::find($this->identification)->update($data);
		}else{
			Evaluation::create($data);
		}
		$this->resetData();
	}

	private function resetData(){
			$this->ponderation = null;
			$this->trimestre = null;
			$this->courId = null;
			$this->classeId = null;
			$this->date_evaluation = null;
			$this->type_evaluation = null;
			$this->identification = null;
			$this->showForm = false;
		
	}
 
	public function modifierEvaluation($id){

		$evalution = Evaluation::find($id);
		$this->ponderation = $evalution->ponderation;
		$this->trimestre = $evalution->trimestre;
		$this->courId = $evalution->cour_id;
		$this->classeId = $evalution->classe_id;
		$this->date_evaluation = $evalution->date_evaluation;
		$this->type_evaluation = $evalution->type_evaluation;
		$this->identification = $evalution->id;
		$this->showForm = true;
	}

	public function annulerEvalution($id){

		$trimestre = Trimestre::current();
		$annee_scolaire = AnneScolaire::current();
		
		$evaluation = Evaluation::find($id);
		if (($evaluation->user_id == auth()->user()->id) and ($evaluation->trimestre == $trimestre->id) and ($annee_scolaire->anne_scolaire_id == $evaluation->anne_scolaire_id) ) {
			//Verfier l'année scolaire
			// Vérifier si c'est le trimestre actuel 
			$evaluation->delete();
				session()->flash('error',"L'evaluation a été annulé avec success");
		}else{
			session()->flash('error',"Impossible d'annuler l'evaluation");
		}
		
	}

	public function ajoutPoint($id){
		dd($id);
	}
}
