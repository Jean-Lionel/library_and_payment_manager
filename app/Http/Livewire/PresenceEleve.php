<?php

namespace App\Http\Livewire;
use App\Models\Presence;
use App\Models\Classe;
use Livewire\Component;

class PresenceEleve extends Component
{
    public $by_classe = null;
    public $showDiv = false;
    // public $listePresence = [];
    public function render()
    {
     return view('livewire.presence-eleve', [
        'classes' => Classe::all(),
        'countpresence' => Presence::where('status_presence', 1)
                        ->where('created_at', 'like', date('Y-m-d') . '%')->count(),
        'countabsence' => Presence::where('status_presence', 0)
                        ->where('created_at', 'like', date('Y-m-d') . '%')->count(),
        'listePresence' => Presence::with('eleve')
        // ->when($this->by_classe, function ($query) {
            ->where('classe_id', $this->by_classe)
        // })
        ->where('created_at', 'like', date('Y-m-d') . '%')
        ->get()
     ]);

    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }
}
