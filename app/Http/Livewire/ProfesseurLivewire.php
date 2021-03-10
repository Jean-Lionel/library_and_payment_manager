<?php

namespace App\Http\Livewire;

use App\Models\Professeur;
use Livewire\Component;
use Livewire\WithPagination;

class ProfesseurLivewire extends Component
{
	 use WithPagination;

    protected $paginationTheme ='bootstrap';
	public $name;
	public $telephone;
	public $search;
    public $identification;

	
    public function render()
    {
    	$proffesseurs = Professeur::latest()
        ->where('name' , 'like', '%'.$this->search.'%')->paginate();

        return view(
            'livewire.professeur-livewire',
            [ 'proffesseurs' => $proffesseurs ]
        );
    }

    public $rules = [
    	'name' => 'required',
    	'telephone' => 'required|min:8'
    ];

    public function saveProffesseur()
    {
    	$this->validate();

        if($this->identification){

            Professeur::find($this->identification)->update([
                'name' => $this->name,
                'telephone' => $this->telephone

                ]);


        }else{

    	Professeur::create([
    		'name' => $this->name,
    		'telephone' => $this->telephone

    	]);
         }

    	$this->reset();

    }

    public function updateProfesseur($id)
    {
        $prof = Professeur::find($id);

        $this->name = $prof->name;
        $this->telephone = $prof->telephone;
        $this->identification = $prof->id;
    }
}
