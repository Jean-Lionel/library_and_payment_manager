<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Cour;
use Livewire\Component;

class EvaluationLivewire extends Component
{
	public $ponderation;
	public $trimestre;
	public $cour_id;
	public $date_evaluation;
	public $anne_scolaire_id;
	public $type_evaluation;
	public $description;
	
	protected $rules = [
		"ponderation" => "numeric|required|min:0",
		"trimestre" => "required",
		"cour_id" => "required",
		"date_evaluation" => "required",
		"type_evaluation" => "required",

	];

    public function render()
    {
    	$anne_scolaire_id = AnneScolaire::latest()->first();
    	$courses = Cour::all();

        return view('livewire.evaluation-livewire',[
        	'anne_scolaire_id' => $anne_scolaire_id,
        	'courses' => $courses,
        ]);
    }
}
