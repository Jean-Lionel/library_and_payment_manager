<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfigurationComponent extends Component
{
    public $etablimssement;
    public $abreviation;
    public $address;
    public $direction_provincial;
    public $direction_communal;
    public $comment;
    public function render()
    {
        return view('livewire.configuration-component')->extends('layouts.base');
    }
}
