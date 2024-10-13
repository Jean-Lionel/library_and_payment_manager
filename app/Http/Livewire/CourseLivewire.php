<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Cour;
use App\Models\CourseCategory;
use App\Models\Level;
use App\Models\Professeur;
use Livewire\Component;
use Livewire\WithPagination;


class CourseLivewire extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
	public $name;
	public $ponderation;
    public $credit;
    public $status = false;
	public $classe_id;
    public $showForm = false;
    public $conduite;
    public $level_id;
    public $category_id;
	public $professeur_id;
    public $identifiant;
    public $search;
    public $ponderation_compentance;
    public $ponderation_examen;

    public function render()
    {
        $professeurs = Professeur::all();
        $classes = Classe::all();
        $levels = Level::all();
        $categories = CourseCategory::all();



        if(auth()->user()->isProfesseur()){

           $prof = auth()->user()->professeur;

            $courses =  Cour::where('name', 'like', '%'. $this->search .'%')
                            ->where('professeur_id',  $prof->id ?? 0 )->latest()->paginate(10);
        }else{
           $courses = Cour::where('name', 'like', '%'. $this->search .'%')->latest()->paginate(10);
        }

        return view('livewire.course-livewire',[
            'professeurs' => $professeurs,
            'classes' => $classes,
            'levels' => $levels,
            'courses' => $courses,
            'categories' => $categories,
        ]);
    }

    protected $rules = [
        "name" => "required",
        "ponderation" => "required|numeric|min:0",
        "professeur_id" => "required",
        "level_id" => "required",
        "credit" => "required",
        "category_id" => "required|numeric|min:0",

    ];
    public function saveCourse(){
        $this->validate();
        $data= [
            "name" => $this->name,
            "ponderation" => $this->ponderation,
            "credit" => $this->credit,
            "professeur_id" => $this->professeur_id,
            "classe_id" => $this->classe_id,
            "conduite" => $this->conduite,
            "status" => $this->status,
            "level_id" => $this->level_id,
            "category_id" => $this->category_id,
            "ponderation_compentance" => $this->ponderation_compentance,
            // "ponderation_ressource" => $this->ponderation_ressource,
            "ponderation_examen" => $this->ponderation_examen,
        ];

        if($this->identifiant){
            Cour::find($this->identifiant)->update($data);

        }else{
            Cour::create($data);
            $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);
        }
        $this->showForm = false;

    	$this->reset();
    }

    public function updateCourse($id){

        $course = Cour::find($id);
        $this->name = $course->name;
        $this->identifiant = $course->id;
        $this->professeur_id = $course->professeur_id;
        $this->classe_id = $course->classe_id;
        $this->category_id = $course->category_id;
        $this->level_id = $course->level_id;
        $this->status = $course->status;
        $this->ponderation = $course->ponderation;
        $this->credit = $course->credit;
        $this->conduite = $course->conduite;
        $this->ponderation_compentance = $course->ponderation_compentance;
        $this->ponderation_examen = $course->ponderation_examen;
        $this->showForm = true;
    }
}
