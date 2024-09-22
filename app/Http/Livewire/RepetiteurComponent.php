<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repetiteur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class RepetiteurComponent extends Component
{
    use WithFileUploads;
    public $nom_repetiteur;
    public $prenom_repetiteur;
    public $postnom_repetiteur;
    public $territoire;
    public $quartier;
    public $avenue;
    public $sexe_repetiteur;
    public $telephone_repetiteur;
    public $date_naissance_repetiteur;
    public $carte_identite_repetiteur;
    public $photo_repetiteur;
    public $cv_repetiteur;
    public $experience;
    public $description_repetiteur;
    public $email_repetiteur;
    public $enseignant_id;
    public $cours = [];

    public $totalSteps = 4;
    public $currentStep = 1;

    public function mount()
    {
        $this->currentStep = 1;
    }

    public function render()
    {
        return view('livewire.repetiteur-component')->layout('layouts.base');
    }

    public function increaseSted()
    {
        $this->resetErrorBag();
        $this->validateData();
        $this->currentStep++;
        if ($this->currentStep > $this->totalSteps) {
            $this->currentStep = $this->totalSteps;
        }
    }

    public function decreaseSted()
    {
        $this->resetErrorBag();
        $this->currentStep--;
        if ($this->currentStep < 1) {
            $this->currentStep = 1;
        }
    }

    public function validateData()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'nom_repetiteur' => 'required|string',
                'prenom_repetiteur' => 'required|string',
                'postnom_repetiteur' => 'required|string',
                'carte_identite_repetiteur' => 'required|string',
                'sexe_repetiteur' => 'required|string',
                'date_naissance_repetiteur' => 'required|string',
            ]);
        }
        elseif ($this->currentStep == 2) {
            $this->validate([
                'email_repetiteur' => 'required|email|unique:repetiteurs',
                'territoire' => 'required|string',
                'quartier' => 'required|string',
                'avenue' => 'required|string',
                'telephone_repetiteur' => 'required|string|min:8|max:13',
            ]);
        }
        elseif ($this->currentStep == 3) {
            $this->validate([
                'cv_repetiteur' => 'required',
                'photo_repetiteur' => 'required',
                'cours' => 'required|array|min:2|max:4',
                'experience' => 'required',
                'description_repetiteur' => 'required|string|min:8',
            ]);
        }
    }

    public function SaveRepetiteur()
    {
        $this->resetErrorBag();
        if ($this->currentStep == 4) {
            $this->validate([
                'cv_repetiteur' => 'required|mimes:doc,docx,pdf|max:1024',
                'photo_repetiteur' => 'required|mimes:png,jpg,jpeg',
            ]);
        }
        $cv_name = $this->cv_repetiteur->getClientOriginalName();
        $uploads = $this->cv_repetiteur->storeAs('repetiteurs_cvs', $cv_name);
        $filename = $this->photo_repetiteur->getClientOriginalName();
        $load = $this->photo_repetiteur->storeAs('photo_cvs', $filename);
        try {
    Repetiteur::create([
    'nom_repetiteur' => $this->nom_repetiteur,
    'prenom_repetiteur' => $this->prenom_repetiteur,
    'postnom_repetiteur' => $this->postnom_repetiteur,
    'territoire' => $this->territoire,
    'quartier' => $this->quartier,
    'avenue' => $this->avenue,
    'sexe_repetiteur' => $this->sexe_repetiteur,
    'telephone_repetiteur' => $this->telephone_repetiteur,
    'date_naissance_repetiteur' => $this->date_naissance_repetiteur,
    'carte_identite_repetiteur' => $this->carte_identite_repetiteur,
    'photo_repetiteur' => $filename,
    'cv_repetiteur' => $cv_name,
    'experience' => $this->experience,
    'description_repetiteur' => $this->description_repetiteur,
    'email_repetiteur' => $this->email_repetiteur,
    'cours' => json_encode($this->cours),
    'user_id' => Auth::user()->id,
    'ecole_id' => auth()->user()->ecole_id,
    ]);
    session()->flash('success', 'Repetiteur Created Successfully.');
    }
     catch (\Exception $ex)
     {
        session()->flash('error','Something goes wrong!!');
     }

    }
}
