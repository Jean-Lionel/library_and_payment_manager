<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Classe;
use App\Models\Horaire;

class HoraireComponent extends Component
{
    public $jour;
    public $teacher;
    public $cours;
    public $classe;
    public $heure;
    public $intervalle;
    public $enseignant;
    public $by_day;
    public $showDiv = false;
    public $search = '';
    public $horaire_id;

    public $deleteId = '';

    protected $rules = [
        'jour' => 'required|string|max:255',
        'heure' => 'required|string|max:255',
        'jour' => 'required|string|max:255',
        // Add other validation rules as needed
    ];

    public function render()
    {
        $getHoraire = Horaire::where('heure', 'like', '%' . $this->search . '%')
        ->orWhere('jour', 'like', '%' . $this->search . '%')
        ->paginate(10);
        $users = User::select('id','name','email')->get();
        $selecthoraire = Horaire::with('classe')
        ->where('jour', $this->by_day)
        ->where('enseignant_id', auth()->user()->id)
        ->get();
        $classes = Classe::select('id','name')->get();
        return view('livewire.horaire-component', [
            'users' => $users,
            'classes' => $classes,
            'selecthoraire' => $selecthoraire,
            'getHoraire' => $getHoraire
        ] )->layout('layouts.base');
    }

    public function openDiv()
    {
        $this->showDiv =! $this->showDiv;
    }

    public function edit(int $id) {
        $horaireId = Horaire::find($id);
        if ($horaireId) {
            $this->horaire_id = $horaireId->id;
            $this->jour = $horaireId->jour;
            $this->heure = $horaireId->heure;
            $this->cours = $horaireId->cours;
        }
        else
        {
            return redirect()->to('/horaire');
        }

    }
    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    public function delete()
    {

        Horaire::find($this->deleteId)->delete();
    }


}
