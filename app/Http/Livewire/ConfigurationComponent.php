<?php

namespace App\Http\Livewire;

use App\Models\Configuration;
use Livewire\Component;

class ConfigurationComponent extends Component
{
    public $etablimssement;
    public $abbreviation;
    public $address;
    public $direction_provincial;
    public $direction_communal;
    public $comment;


    public function render()
    {
        return view('livewire.configuration-component')->extends('layouts.base');
    }

    protected $rules = [
        'etablimssement' => 'required',
        'address' => 'required',

    ];

    public function saveConfiguration()
    {
        $this->validate();
        // code...

        $data = [
            'etablimssement' => $this->etablimssement,
            'abbreviation' => $this->abbreviation,
            'address' => $this->address,
            'direction_provincial' => $this->direction_provincial,
            'direction_communal' => $this->direction_communal,
            'comment' => $this->comment,
        ];

        Configuration::create($data);
        $this->dispatchBrowserEvent('success', ['message' => 'Nouveau configuration effectuée avec succès']);
        $this->reset();
    }
}
