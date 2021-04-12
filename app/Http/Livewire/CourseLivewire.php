<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Cour;
use App\Models\Professeur;
use Livewire\Component;

class CourseLivewire extends Component
{

	public $name;
	public $ponderation;
	public $classe_id;
	public $professeur_id;
    public $identifiant;

    public function render()
    {
        $professeurs = Professeur::all();
        $classes = Classe::all();
        $courses = Cour::latest()->paginate();

        return view('livewire.course-livewire',[
            'professeurs' => $professeurs,
            'classes' => $classes,
            'courses' => $courses,
        ]);
    }

    protected $rules = [
        "name" => "required",
        "ponderation" => "required|numeric|min:0",
        "professeur_id" => "required",
        "classe_id" => "required",

    ];
    public function saveCourse(){
        $this->validate();

        $data= [
            "name" => $this->name,
            "ponderation" => $this->ponderation,
            "professeur_id" => $this->professeur_id,
            "classe_id" => $this->classe_id,
        ];

        if($this->identifiant){
            Cour::find($this->identifiant)->update($data);

        }else{
            Cour::create($data);
        }

    	$this->reset();
    }

    public function updateCourse($id){

        $course = Cour::find($id);

        $this->name = $course->name;
        $this->identifiant = $course->id;
        $this->professeur_id = $course->professeur_id;
        $this->classe_id = $course->classe_id;
        $this->ponderation = $course->ponderation;
      

    }
}
