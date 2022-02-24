<?php

namespace App\Http\Livewire;

use App\Models\AnneScolaire;
use App\Models\Trimestre;
use Livewire\Component;

class ConfigurationLivewire extends Component
{
	public $showInputYear = false;
	public $annee;
    public $choosedTrimestre;

    public function render()
    {
        return view('livewire.configuration-livewire',
        	[
        		'currentAnneScolaire' =>  AnneScolaire::latest()->first(),
                'trimestres' => Trimestre::all(),
                'curreTrimestre' => Trimestre::where('is_current',1)->first()
        	]
    	);
    }

    public function updatedChoosedTrimestre(){
        //dd($this->choosedTrimestre);
        $trimestres = Trimestre::all();

        foreach ($trimestres as $trimestre){
            $trimestre->is_current = false;
            $trimestre->save();
        }

        $curreTrim = Trimestre::find($this->choosedTrimestre);
        $curreTrim->is_current = true;
        $curreTrim->save();
    }

    protected $rules = [
    	'annee' => 'required'
    ];

    public function saveYear()
    {
    	$this->validate();

    	AnneScolaire::create([
    		'name' => $this->annee
    	]);

    	$this->reset();
    }
}
