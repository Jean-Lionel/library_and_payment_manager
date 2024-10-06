<?php

namespace App\Http\Livewire;
use App\Models\Presence;
use App\Models\Classe;
use Livewire\Component;

class PresenceEleve extends Component
{
    public $by_classe = null;
    // public $listePresence = [];
    public function render()
    {
     return view('livewire.presence-eleve', [
        'classes' => Classe::all(),
        'listePresence' => Presence::with('eleve')
        ->when($this->by_classe, function ($query) {
            $query->where('classe_id', $this->by_classe);
        })
        ->where('created_at', 'like', date('Y-m-d') . '%')
        ->get()
     ]);

    }
}
