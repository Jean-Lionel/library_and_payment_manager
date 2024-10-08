<?php

namespace App\Http\Livewire;

use App\Models\Depense;
use Livewire\Component;
use Livewire\WithPagination;

class DepenseLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme ='bootstrap';
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
        $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);
    	$this->reset();
    }

}
