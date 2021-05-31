<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TableHeader extends Component
{
	public string $direction;
	public string $name;
	public string $label;
	public string $field;



	public function __construct($direction ,$name,$label,$field){
		$this->direction = $direction;
		$this->name = $name;
		$this->label = $label;
		$this->field = $field;
	}
    public function render()
    {
        return view('livewire.table-header',
        		['visible' => $this->field == $this->name]

    );
    }
}
