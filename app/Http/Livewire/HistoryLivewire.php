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

	// public function mount()
     
    public function render()
    {
    	$emprutsLivre = Emprut::latest()->paginate();

        // dump($emprutsLivre->detailsBooks);

  
        return view('livewire.history-livewire', [
        	'empruts' => $emprutsLivre
        ]);
    }
}
