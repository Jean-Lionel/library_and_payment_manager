<?php

namespace App\Http\Livewire\Punition;

use App\Models\Punition;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{

    public $type_punition_id;
    public $description;
    public $date_punition;
    public $statut = 'en_cours';
    public $eleve_id;
    public $enseignant_id;
    public $user_id;

    protected $rules = [
        'type_punition_id' => 'required|string',
        'description' => 'nullable|string',
        'date_punition' => 'required|date',
        'statut' => 'required|string',
        'eleve_id' => 'required|string',
        'enseignant_id' => 'nullable|string',
        'user_id' => 'required|string',
    ];

    public function mount($eleve_id)
    {
        $this->user_id = Auth::id(); // Récupère l'ID de l'utilisateur connecté
        $this->eleve_id = $eleve_id; // Récupère l'ID de l'utilisateur connecté
    }

    public function submit()
    {
        $this->validate();

        Punition::create([
            'type_punition_id' => $this->type_punition_id,
            'description' => $this->description,
            'date_punition' => $this->date_punition,
            'statut' => $this->statut,
            'eleve_id' => $this->eleve_id,
            'enseignant_id' => $this->enseignant_id,
            'user_id' => $this->user_id,
        ]);

        session()->flash('message', 'Punition ajoutée avec succès.');
        $this->reset(); // Réinitialise les champs du formulaire
    }

   
    public function render()
    {
        return view('livewire.punition.create');
    }
}
