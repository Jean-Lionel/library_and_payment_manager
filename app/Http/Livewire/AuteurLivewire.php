<?php

namespace App\Http\Livewire;

use App\Models\Auteur;
use Livewire\Component;
use Livewire\WithPagination;

class AuteurLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme ='bootstrap';
	public $name;
	public $pay_orgine;
    public $identification;
    public $search;

    public function render()
    {

    	$auteurs = Auteur::where('name','like', '%'.$this->search.'%')
                        ->orWhere('pay_orgine', 'like' , '%'.$this->search.'%')->latest()->paginate();
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
        if($this->identification){
            $auteur = Auteur::find($this->identification);
             $auteur->update([

                'name' => $this->name,
                'pay_orgine' => $this->pay_orgine

             ]);

            //  session()->flash('message', 'Modification réussi');
            $this->dispatchBrowserEvent('success', ['message' => 'Modification effectué avec succès']);

        }else{
            Auteur::create(
            [
                'name' => $this->name,
                'pay_orgine' => $this->pay_orgine
            ]

             );

            //  session()->flash('message', 'Enregistrement réussi');
            $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);

        }
    	$this->reset();


    }

    public function updateAuteur($id)
    {
        $auteur = Auteur::find($id);
        $this->name = $auteur->name;
        $this->pay_orgine = $auteur->pay_orgine;
        $this->identification = $auteur->id;

    }
}
