<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Repetiteur;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

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
    public $search = '';

    public $totalSteps = 4;
    public $currentStep = 1;

    public function mount()
    {
        $this->currentStep = 1;
    }


    public function render()
    {
        $repetiteur = Repetiteur::where('nom_repetiteur', 'like', '%'.$this->search.'%')->paginate(10);
        return view('livewire.repetiteur-component', compact('repetiteur'))->layout('layouts.base');
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
        if ($this->currentStep == 3) {
           $valid_data =  $this->validate([
                'photo_repetiteur' => 'required|mimes:png,jpg,jpeg|image|max:1024',
            ]);
        }
        // $filename = $this->photo_repetiteur->getClientOriginalName();
        // $load = $this->photo_repetiteur->store('photo_cvs', $filename);

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
                // 'photo_repetiteur' => $filename,
                'experience' => $this->experience,
                'description_repetiteur' => $this->description_repetiteur,
                'email_repetiteur' => $this->email_repetiteur,
                'cours' => json_encode($this->cours),
                'user_id' => Auth::user()->id,
                'ecole_id' => auth()->user()->ecole_id,
            ]);
            $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);
            // session()->flash('success', 'Repetiteur Created Successfully.');
            dd('Good');
        }
        catch (\Exception $ex)
        {

            session()->flash('error',$ex->getMessage());
            dd($ex);
        }

    }
}
