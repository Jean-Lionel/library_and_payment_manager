<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Stock;
use Livewire\Component;

class CategoryLivewire extends Component
{
	public $name;
	public $identifiant;
	public $stock_id;

	private $categories;
	public $stoks;

	public function mount(){
		$this->stoks = Stock::all();
	}

    public function render()
    {
        return view('livewire.category-livewire',
        	[
        		'categories' => Category::latest()->paginate()
        	]
    	);
    }

    protected $rules=[
    	'name' => 'required',
    	'stock_id' => 'required'

    ];

    public function saveCategory(){
    	$this->validate();
    	if($this->identifiant){
    		$category = Category::find($this->identifiant);

    		$category->update([
    			'name' => $this->name,
    			'stock_id' => $this->stock_id,
    		]);
    	}else{
    		Category::Create([
    			'name' => $this->name,
    			'stock_id' => $this->stock_id,
    		]);
    	}


    	$this->resetInput();
    }

    public function edit($id){
    	$category = Category::find($id);

    	$this->name = $category->name;
    	$this->stock_id = $category->stock_id;
    	$this->identifiant = $category->id;
    }

    public function destroy($id){
    	Category::find($id)->delete();
    }

    private function resetInput(){

    	$this->name = "";
    	$this->stock_id = "";
    	$this->identifiant = "";

    }
}
