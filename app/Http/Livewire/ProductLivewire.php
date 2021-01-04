<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductLivewire extends Component
{

	public $name;
	public $identifiant;
	public $marque;
	public $quantite;
	public $price;
	public $category_id;
	public $categories;


	protected $rules = [
		'name' => 'required|min:3',
		'marque' => 'required|min:3',
		'quantite' => 'required|numeric|min:0',
		'price' => 'required|numeric|min:0',

	];


	public function mount(){
		$this->categories = Category::all();
	}

	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
		
	}

	public function saveProduct(){
		$this->validate();

		if($this->identifiant){
			$product = Product::find($this->identifiant);

			$product->update([

				'name' => $this->name,
				'marque' => $this->marque,
				'quantite' => $this->quantite,
				'price' => $this->price,
				'category_id' => $this->category_id,
			]);

		}else{

			Product::create([
				'name' => $this->name,
				'marque' => $this->marque,
				'quantite' => $this->quantite,
				'price' => $this->price,
				'category_id' => $this->category_id,
			]);

		}


		$this->resetInput();

	}


	private function resetInput(){

		 $this->name = "";
		 $this->marque ="";
		 $this->quantite = "";
		 $this->price = "";
	}


	public function render()
	{
		return view('livewire.product-livewire');
	}
}
