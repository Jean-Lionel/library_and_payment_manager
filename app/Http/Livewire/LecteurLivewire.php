<?php

namespace App\Http\Livewire;

use App\Models\Lecteur;
use Livewire\Component;
use Livewire\WithPagination;

class LecteurLivewire extends Component
{

    use WithPagination;

    protected $paginationTheme ='bootstrap';
	public $name;
	public $telephone;
	public $description;
    public $search;
    public $identification;

    public function render()
    {

        $lecteurs = Lecteur::latest()->where('name','like', '%'.$this->search.'%')
                            ->orWhere('telephone', 'like', '%'.$this->search.'%')->paginate();

        return view('livewire.lecteur-livewire', ['lecteurs' => $lecteurs]);
    }

    protected $rules = [

    	'name' => 'required|min:3'

    ];


    public function saveLecteur()
    {
    	$this->validate();

        if($this->identification){
            Lecteur::find($this->identification)->update([
                    'name' => $this->name,
                    'telephone' => $this->telephone,
                    'description' => $this->description,

            ]);

        }else{
            Lecteur::create([
            'name' => $this->name,
            'telephone' => $this->telephone,
            'description' => $this->description,

        ]);
        }
		$this->reset();
    }

    public function updateLecteur($id){
        $lecteur = Lecteur::find($id);
        $this->identification = $lecteur->id;
        $this->name = $lecteur->name;
        $this->telephone = $lecteur->telephone;
        $this->description = $lecteur->description;
    }
}
