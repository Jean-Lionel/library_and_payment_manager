<?php

namespace App\Http\Livewire;

use App\Models\Classe;
use App\Models\Evaluation;
use Livewire\Component;

class BulletinComponent extends Component
{
    public $anneScolaire = 3;
    public $classe = 2;

    public function render()
    {
        $anne_scolaire_id = $this->anneScolaire;
        $classe_id = $this->classe;
        $evaluations = Evaluation::where('anne_scolaire_id', '=', $anne_scolaire_id)
                    ->where('classe_id','=', $classe_id)->get();


        $courses = Classe::findOrFail($classe_id);


        // foreach($evaluations as $evaluation){

        //     dd($evaluation->cour->ponderation);

        //     // foreach($evaluation->point_obentu as $point_obentu){
        //     //     dd($point_obentu->eleve);
        //     // }
        // }
        
        return view('livewire.bulletin-component',[
            'evaluations' => $evaluations,
            'courses' => $courses

        ]);
    }
}
