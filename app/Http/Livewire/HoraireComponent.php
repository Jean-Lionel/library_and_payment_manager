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
    public $intervalle;
    public $enseignant;
    public $by_day;

    public function render()
    {
        $users = User::select('id','name','email')->get();
        $selecthoraire = Horaire::with('classe')
        ->where('jour', $this->by_day)
        ->where('enseignant_id', auth()->user()->id)
        ->get();
        $classes = Classe::select('id','name')->get();
        return view('livewire.horaire-component', [
            'users' => $users,
            'classes' => $classes,
            'selecthoraire' => $selecthoraire
        ] )->layout('layouts.base');
    }

}
