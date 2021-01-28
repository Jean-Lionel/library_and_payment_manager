<?php

namespace App\Http\Livewire;

use App\Models\Etagere;
use Livewire\Component;

class EtagereLivewire extends Component
{
	public $name;
	public $description;


    public function render()
    {
        return view('livewire.etagere-livewire');
    }

    protected $rules = [
    	'name' => 'required'
    ];

    public function saveEtagere()
    {
    	$this->validate();

    	Etagere::create([

    		'name' => $this->name,
    		'description' => $this->description
    	]);

    	session()->flash('message', 'Réussi');
    }
}
