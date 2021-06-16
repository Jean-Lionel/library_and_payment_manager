<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UtilisateurComponent extends Component
{
    public $name ;
    public $password;
    public $email;

    public function render()
    {
        return view('livewire.utilisateur-component');
    }
}
