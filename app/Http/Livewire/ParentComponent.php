<?php

namespace App\Http\Livewire;

use App\Models\Eleve;
use App\Models\EleveParent;
use Livewire\Component;

class ParentComponent extends Component
{
    public $firstName;
    public $lastName;
    public $email;
    public $telephone;
    public $identification;
    public $address;
    public $showForm = false;
    public $selectedParent = 0;

    public function render()
    {
        $parents = EleveParent::latest()->paginate();

        return view('livewire.parent-component',[
            'parents' => $parents
        ])->extends('layouts.base');
    }

    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'unique:eleve_parents,id',
    ];

    public function saveParent(){
        $this->validate();

        $data = [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'address' => $this->address,
            'user_id' => auth()->user()->id,
        ];
          //dd($this->identification);
        if ($this->identification) {
            // code...
            EleveParent::find($this->identification)->update($data);
        }else{
            EleveParent::create($data);
        }
        $this->reset();
    }

    public function modifierParent($id){
        $parent = EleveParent::findOrFail($id);

        $this->firstName = $parent->firstName;
        $this->lastName = $parent->lastName;
        $this->email = $parent->email;
        $this->telephone = $parent->telephone;
        $this->address = $parent->address;
        $this->identification = $parent->id;
        $this->showForm = true;
    }

    public function choosedParent($id){
        $this->selectedParent = $id;
    }

   public function supprimerEnfant($id){
        $eleve = Eleve::findOrFail($id);
        $eleve->parent_id =  NULL;
        $eleve->save();
    }
}
