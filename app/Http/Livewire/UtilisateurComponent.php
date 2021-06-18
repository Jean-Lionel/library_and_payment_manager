<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UtilisateurComponent extends Component
{
    public $name ;
    public $password;
    public $email;
    public $showForm = false;

    public function render()
    {
        return view('livewire.utilisateur-component');
    }

    public function saveUser(){
        dd("SAVE");
    }
}
