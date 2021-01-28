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

	
    public function render()
    {
    	$proffesseurs = Professeur::latest()->paginate();

        return view(
            'livewire.professeur-livewire',
            [ 'proffesseurs' => $proffesseurs ]
        );
    }

    public $rules = [
    	'name' => 'required',
    	'telephone' => 'required'
    ];

    public function saveProffesseur()
    {
    	$this->validate();

    	Professeur::create([
    		'name' => $this->name,
    		'telephone' => $this->telephone

    	]);

    	$this->reset();

    }
}
