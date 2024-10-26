<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Communique;


class CommuniqueComponent extends Component
{
    public $titre;
    public $message;

    public function render()
    {
        $communiques = Communique::select('id','titre','message')->paginate(2);
        return view('livewire.communique-component', compact('communiques'));
    }

    public function saveCommuniquer()
    {
        $this->validate([
            'titre' => 'required|string|min:10',
            'message' => 'required|string|min:15',
        ]);
        Communique::create([
            'titre' => $this->titre,
            'message' => $this->message,
            'ecole_id' => auth()->user()->ecole_id
        ]);
        $this->dispatchBrowserEvent('success', ['message' => 'Communiqué envoyé avec succès']);
        // dd('Good');
    }
}
