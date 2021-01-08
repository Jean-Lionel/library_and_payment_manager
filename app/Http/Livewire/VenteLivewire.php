<?php

namespace App\Http\Livewire;


use App\Models\DetailOrder;
use App\Models\FollowProduct;
use App\Models\Order;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
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
	public $client_name;
	public $inputFormControl = "";

	public $order;
	public $printOrder= false;

	public function mount()
	{
		$this->order = Order::latest()->first();
	}

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


	public function  storeInvoice()
	{
		if(Cart::count() <=0){
			session()->flash('error','Choissisez au moins un produit');

		}else{

			if($this->noLongerStock()){
				session()->flash('error',"Vérifier que vous avez tout les produits dans votre stock");
			}else{
				try {
					DB::beginTransaction();
					$this->stockUpdated();

					$order = Order::create([
						'montant' => Cart::total(),
						'tax' => Cart::tax(),
						
						'amount_tax' => Cart::subtotal(),
						'details'=> serialize($this->extractCart()),
						'client'=> $this->client_name ?? "X",
						'eleve_id'=> 6,
						
					]);

					$this->order = $order;

					$this->storeTodetailOder($order->id);

					Cart::destroy();
					DB::commit();
					
				} catch (\Exception $e) {

					DB::rollback();
					session()->flash('error', $e->getMessage());
					
				}
			}
		}
	}

	private function noLongerStock()
	{
		foreach (Cart::content() as $item) {
			$product = Product::find($item->model->id);

			if ($item->qty > $product->quantite) {
				return true;
			}
		}
		return false;
	}

	private function stockUpdated()
	{
		foreach (Cart::content() as $item) {
			$product = Product::find($item->model->id);
			$product->update(['quantite' => $product->quantite - $item->qty]);
		}
	}


	private function storeTodetailOder($order_id){
		foreach (Cart::content() as $item) {

			DetailOrder::create([

				'product_id' => $item->model->id,
				'quantite' => $item->qty,
				'price_unitaire' => $item->price,
				'order_id' => $order_id,
				'price' => $item->price,
				'montant' => $item->subtotal() ,

			]);


			FollowProduct::create([
				'quantite' => $item->qty,
				'products' => $item->model->toJson(),
				'action' => 'SORTIE',
				'product_id' => $item->model->id,
			]);

		}
	}


	

    private function extractCart(){

        $products = [];
        foreach (Cart::content() as $item) {
            // dump($item);

            $products[] = [
                'id' => $item->id,
                'name' => $item->name,
                'rowId' => $item->rowId,
                'price' => $item->price,
                'quantite' => $item->qty,
                
            ];

          
        }

        return $products;
    }



    public function imprimerFacture(){

    }



}
