<?php

namespace App\Http\Livewire;

use App\Models\Etagere;
use Livewire\Component;
use Livewire\WithPagination;

class EtagereLivewire extends Component
{
    use WithPagination;

    protected $paginationTheme ='bootstrap';
	public $name;
	public $description;


    public function render()
    {
        $etageres = Etagere::latest()->paginate();

        return view('livewire.etagere-livewire',
            [
                'etageres' => $etageres
            ]

    );
    }

    protected $rules = [
    	'name' => 'required'
    ];

    public function saveEtagere()
    {
    	$this->validate();

    	Etagere::create([

    		'name' => $this->name,
    		'description' => $this->description
    	]);
        session()->flash('message', 'Réussi');

        $this->render();

    }
}
