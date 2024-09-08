<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Classe;
use App\Models\Horaire;

class HoraireComponent extends Component
{
    public $jour;
    public $teacher;
    public $cours;
    public $classe;
    public $heure;

    public function render()
    {
        $users = User::select('id','name','email')->get();
        $classes = Classe::select('id','name')->get();
        return view('livewire.horaire-component', [
            'users' => $users,
            'classes' => $classes
        ] )->layout('layouts.base');
    }

}
