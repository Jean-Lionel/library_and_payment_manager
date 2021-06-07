<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Cour;
use App\Models\CourseCategory;
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
	public $classe_id;
    public $category_id;
	public $professeur_id;
    public $identifiant;
    public $search;

    public function render()
    {
        $professeurs = Professeur::all();
        $classes = Classe::all();
        $categories = CourseCategory::all();
        $courses = Cour::where('name', 'like', '%'. $this->search .'%')->latest()->paginate(10);

        return view('livewire.course-livewire',[
            'professeurs' => $professeurs,
            'classes' => $classes,
            'courses' => $courses,
            'categories' => $categories,
        ]);
    }

    protected $rules = [
        "name" => "required",
        "ponderation" => "required|numeric|min:0",
        "professeur_id" => "required",
        "classe_id" => "required",
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
            "category_id" => $this->category_id,
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
        $this->category_id = $course->category_id;
        $this->ponderation = $course->ponderation;
        $this->credit = $course->credit;
      

    }
}
