<?php

namespace App\Http\Livewire;

use App\Models\Auteur;
use Livewire\Component;

class AuteurLivewire extends Component
{
	public $name;
	public $pay_orgine;

    public function render()
    {
    	$auteurs = Auteur::latest()->paginate();
        return view('livewire.auteur-livewire' ,[

        	'auteurs' => $auteurs
        ]);
    }

    protected $rules = [
    	'name' => 'required'

    ];

    public function saveAuthor()
    {
    	$this->validate();


    	Auteur::create(
    		[
    			'name' => $this->name,
    			'pay_orgine' => $this->pay_orgine
    		]

    	);

    	$this->reset();

    	 session()->flash('message', 'Enregistrement réussi');
    }
}
