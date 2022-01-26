<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RapportController;
use App\Models\AnneScolaire;
use Livewire\Component;

class RapportHeader extends Component
{
    public $anne_scolaire_id;

    protected $queryString = ['anne_scolaire_id' => ['as' => 's']];

    public function render()
    {
        $annee_scolaires = AnneScolaire::latest()->get();
        return view('livewire.rapport-header',[
            'annee_scolaires' => $annee_scolaires

        ]);
    }

    public function searchEffectif(){
        $r = new RapportController;
        $r->getEffectifs($this->anne_scolaire_id);
    }
}
