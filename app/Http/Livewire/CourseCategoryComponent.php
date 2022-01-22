<?php

namespace App\Http\Livewire;

use App\Models\CourseCategory;
use Livewire\Component;
use Livewire\WithPagination;

class CourseCategoryComponent extends Component
{
    use WithPagination;

    protected $paginationTheme ='bootstrap'; 
    public string $name = "";
    public string $ordre = "";
    public string $search = "";
    public int $identifiant = 0;
    public int $selectId = 0;
    public  $showForm;


    public function render()
    {

        $categories = CourseCategory::where('name','like','%'.$this->search.'%')->latest()->paginate();
        return view('livewire.course-category-component',[
            'categories' =>  $categories

        ]);
    }

    protected $rules = [
        'name' => 'required'
    ];

    public function saveCouseCategory(){
        $this->validate();
        $data = [
            'name' => $this->name,
            'ordre' => $this->ordre,
        ];
        if($this->identifiant){
          CourseCategory::findOrFail($this->identifiant)->update($data);
        }else{
            CourseCategory::create($data);
        }

        $this->reset();
    }

    public function editCategory($element){
        $this->selectId = $element['id'];
        $this->name = $element['name'];
        $this->ordre = $element['ordre'];
        $this->identifiant = $element['id'];
    }

    public function openForm(){
        $this->showForm = true;
    }
}
