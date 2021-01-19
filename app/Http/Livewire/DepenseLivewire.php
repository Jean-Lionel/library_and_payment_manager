<?php

namespace App\Http\Livewire;

use App\Models\Depense;
use Livewire\Component;

class DepenseLivewire extends Component
{
	public $action;
	public $montant;
	public $description;
	public $keyWord;
	public $debut;
	public $fin;
	public $ShowForm= false;

    public function render()
    {
    	$keySearch = '%'.$this->keyWord.'%';

        return view('livewire.depense-livewire',[
        	'depenses' => Depense::latest()
        							->where('action','like',$keySearch )
        							->whereBetween('created_at',[$this->debut, $this->fin])
        							->paginate()
        ]);
    }

    protected $rules = [
    	'action' => 'required',
    	'montant' => 'required|min:0',
    	'description' => 'required',
    ];


    public function saveDepense(){
    	$this->validate();

    	Depense::create([
    		'action' => $this->action,
    		'montant' => $this->montant,
    		'description' => $this->description,

    	]);

    	$this->reset();
    }

}
