<?php

namespace App\Http\Livewire;

use App\Models\Emprut;
use Livewire\Component;
use Livewire\WithPagination;

class HistoryLivewire extends Component
{
	use WithPagination;

	protected $paginationTheme ='bootstrap';
	//public $empruts;
    public  $searchValue = '';

	// public function mount()
     
    public function render()
    {
        
    	$emprutsLivre = Emprut::with(['detailsBooks', 'eleve'])->latest()->get();

        return view('livewire.history-livewire', [
        	'empruts' => $emprutsLivre
        ]);
    }
}


// $categories = Categories::whereHas('products', function ($query) use ($searchString){
//         $query->where('name', 'like', '%'.$searchString.'%');
//     })
//     ->with(['products' => function($query) use ($searchString){
//         $query->where('name', 'like', '%'.$searchString.'%');
//     }])->get();

// foreach($categories as $category){
//     echo $category->name . ':' . PHP_EOL;
//     foreach($category->products as $product){
//         echo . '-' . $product->name . PHP_EOL;
//     }
// }