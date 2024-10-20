<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Eleve;
use App\Models\Ecole;
use App\Models\Classe;
use App\Models\Depense;
use App\Models\Paiement;
use App\Models\Book;
use App\Models\Repetiteur;

class WelcomeComponent extends Component
{

    public function render()
    {

        return view('livewire.welcome-component', [
            'ecoles' => Ecole::paginate(10),
            'count_ecole' => Ecole::count(),
            'classes' => Classe::all()->count(),
            'books' => Book::all()->count(),
            'users' => User::all()->count(),
            'count_eleve' => Eleve::count(),
            'eleve_by_ecole' => Eleve::where('ecole_id', auth()->user()->ecole_id)->count(),
            'classe_by_ecole' => Classe::where('ecole_id', auth()->user()->ecole_id)->count(),
            'repetiteur_by_ecole' => Repetiteur::where('ecole_id', auth()->user()->ecole_id)->count(),
            'count_repetiteur' => Repetiteur::count()
        ])->layout('layouts.base');;
    }
}
