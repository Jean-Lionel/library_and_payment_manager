<?php

namespace App\Http\Livewire;

use App\Models\Burundizipcode;
use Livewire\Component;

class AddresseComponent extends Component
{
    public $province;
    public $communes;
    public $commune;
    public $collines;
    public $colline;

    public function render()
    {
        $provinces = Burundizipcode::provinces();

        return view('livewire.addresse-component',[
            'provinces' => $provinces
        ]);
    }

    public function updatedProvince(){

        $data = Burundizipcode::communes($this->province);
        if (count($data)) {
            $this->communes = $data;
        }
        
    }

    public function updatedCommune(){
        $data = Burundizipcode::collines("NTAHANGWA");

        if (count($data)) {
            // code...
            $this->collines = $data;
        }
    }
}
