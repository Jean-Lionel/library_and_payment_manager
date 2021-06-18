<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductLivewire extends Component
{

	    use WithPagination;

    protected $paginationTheme = 'bootstrap';


	public $name;
	public $identifiant;
	public $marque;
	public $quantite;
	public $price;
	public $category_id;
	public $categories;
	
	public $searchTerm;
	public $showForm = false;


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

		 session()->flash('message', 'Opération réussi');

		 return $this->render();

		// return redirect()->to('/stoks');

	}


	private function resetInput(){

		 $this->name = "";
		 $this->marque ="";
		 $this->quantite = "";
		 $this->price = "";
	}


	public function edit($id){
		$product = Product::find($id);

		$this->identifiant = $product->id;
		$this->name = $product->name;
		$this->marque = $product->marque;
		$this->quantite = $product->quantite;
		$this->price = $product->price;
		$this->category_id = $product->category_id;

		if($this->showForm == false)
			$this->showForm = true;

	}


	public function render()
	{
		$search = '%'.$this->searchTerm.'%';
		$products = Product::latest()
							->where('marque','like',$search)
							->orWhere('name','like',$search)
							->orWhere('price','like',$search)
							->paginate();
		return view('livewire.product-livewire',
			[
				'products' => $products
			]

		);
	}

	public function toogleShowForm(){
		$this->showForm = !$this->showForm;
	}
}
