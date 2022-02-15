<?php

namespace App\Http\Livewire;

use App\Models\Classement;
use App\Models\Etagere;
use Livewire\Component;
use Livewire\WithPagination;

class ClassementLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme ='bootstrap';
	public $name;
	public $etagere_id;
    public $etageres;
    public $identification;
    public $search;

    public function mount()
    {
        $this->etageres = Etagere::all();
    }

    public function render()
    {
        $this->etageres = Etagere::all();
        $classements = Classement::where('name', 'like', '%'.$this->search.'%')->paginate();
        return view('livewire.classement-livewire', [

            'classements' => $classements
        ]);
    }

    public $rules = [
    	'name' => 'required',
    	'etagere_id' => 'required'
    ];

    public function saveClassement()
    {
    	$this->validate();

        if($this->identification){
            Classement::find($this->identification)->update([
            'name' => $this->name,
            'etagere_id' => $this->etagere_id,

        ]);

        }else{

        Classement::create([
            'name' => $this->name,
            'etagere_id' => $this->etagere_id,

        ]);

        }

    	session()->flash('message', "Réussi");

        $this->reset();
    }

    public function updateClassement($id)
    {
        $classement = Classement::find($id);
        $this->name = $classement->name;
        $this->etagere_id = $classement->etagere_id;
        $this->identification = $classement->id;
    }
}
