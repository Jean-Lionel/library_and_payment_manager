<?php

namespace App\Http\Livewire;

use App\Models\Classement;
use Livewire\Component;

class ClassementLivewire extends Component
{
	public $name;
	public $etagere_id;

    public function render()
    {
        return view('livewire.classement-livewire');
    }

    public $rules = [
    	'name' => 'required',
    	'etagere_id' => 'required'
    ];

    public function saveClassement()
    {
    	$this->validate();

    	Classement::create([
    		'name' => $this->name,
    		'etagere_id' => $this->etagere_id,

    	]);

    	session()->flash('message', "Réussi");
    }
}
