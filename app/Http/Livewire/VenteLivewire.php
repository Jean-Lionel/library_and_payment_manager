<?php

namespace App\Http\Livewire;


use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class VenteLivewire extends Component
{
	 use WithPagination;

    protected $paginationTheme = 'bootstrap';

	private $products;
	public $searchItem;
	public $choose_quantite;
	public $product_qty;

	public $inputFormControl = "";


	public function render()
	{
		
		$seach = '%'.$this->searchItem.'%';
		$this->products = Product::latest()
										->where('name','like',$seach)
										->where('quantite','>',0)
										->paginate(3);
		
		return view('livewire.vente-livewire',[
			'products' => $this->products
		]);
	}


	public function addToCart($product)
	{
		$product = Product::find($product);

		Cart::add($product->id, $product->name, 1,	$product->price)->associate('App\Models\Product');

		//
	}

	public function removeItem($rowId){
		Cart::remove($rowId);

		//dump("Je suis cool");
	}


	public function updateQuantite($val , $rowId){
		
		$item = Cart::get($rowId);

		if($item->model->quantite >= $val){
			Cart::update($rowId,$val);

			$this->inputFormControl = "is-valid";
		}else{
			$this->inputFormControl = "is-invalid";
		}

		
	}


}
