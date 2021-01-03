<?php

namespace App\Http\Livewire;

use App\Models\Stock;
use Livewire\Component;

class StockLivewire extends Component
{
	public $identifiant;
	public $name;
	

	public function render()
	{
		return view('livewire.stock-livewire');
	}

	protected $rules =[
		'name' => 'required'

	];

	public function updated($propertyName){
		$this->validateOnly($propertyName);
	}

	public function saveStock(){
		$this->validate();

		if($this->identifiant == null){
			Stock::create([
				'name' => $this->name
			]);

		}else{

			$stock = Stock::find($this->identifiant);

			$stock->update([
				'name' => $this->name

			]);

		}

	}
}
