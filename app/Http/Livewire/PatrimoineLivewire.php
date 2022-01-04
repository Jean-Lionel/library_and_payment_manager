<?php

namespace App\Http\Livewire;

use App\Models\Patrimoine;
use Livewire\Component;
use Livewire\WithPagination;

class PatrimoineLivewire extends Component
{
	use WithPagination;

	protected $paginationTheme ='bootstrap';

	public  $identifiant=null;
	public  $name;
	public  $description;
	public  $quantite_total;
	public  $qte_en_mauvaise_etat;
	public  $quantite_en_bonne_etat;
	public  $open = true;
	public  $showForm = true;


	private $patrimoines;

	protected $rules=[

		'name' => 'required|min:3',
		'description' => 'required|min:3',
		'quantite_total' => 'required|numeric|min:0',
		'qte_en_mauvaise_etat' => 'required|numeric|min:0',
		'quantite_en_bonne_etat' => 'required|numeric|min:0',
	];

	public function mount(){
		$this->patrimoines = Patrimoine::latest()->paginate();
	}



	public function render()
	{
		$this->patrimoines = Patrimoine::latest()->paginate();
		return view('livewire.patrimoine-livewire',
			[
				'patrimoines' => $this->patrimoines
			]

		);
	}

	public function updated($propertyName){
		$this->validateOnly($propertyName);
	}



	public function resetInput(){
		$this->name = "";
		$this->identifiant = null;
		$this->description = "";
		$this->quantite_total = "";
		$this->qte_en_mauvaise_etat = "";
		$this->quantite_en_bonne_etat = "";

	}


	public function savePatrimoine(){
		$this->validate();

		if($this->identifiant){
			$patrimoine = Patrimoine::find($this->identifiant);
			$patrimoine->update([

				'name' => $this->name,
				'description' => $this->description,
				'quantite_total' => $this->quantite_total,
				'qte_en_mauvaise_etat' =>$this->qte_en_mauvaise_etat,
				'quantite_en_bonne_etat' => $this->quantite_en_bonne_etat,

			]);


		}else{
			Patrimoine::create([
				'name' => $this->name,
				'description' => $this->description,
				'quantite_total' => $this->quantite_total,
				'qte_en_mauvaise_etat' =>$this->qte_en_mauvaise_etat,
				'quantite_en_bonne_etat' => $this->quantite_en_bonne_etat,

			]);

		}

		

		$this->resetInput();
		$this->render();
	}

	public function edit($id){
		$patrimoine = Patrimoine::find($id);

		$this->name = $patrimoine->name;
		$this->identifiant = $patrimoine->id;
		$this->description = $patrimoine->description;
		$this->quantite_total = $patrimoine->quantite_total;
		$this->qte_en_mauvaise_etat = $patrimoine->qte_en_mauvaise_etat;
		$this->quantite_en_bonne_etat =$patrimoine->quantite_en_bonne_etat;

	}



	public function effacer($id){
		$patrimoine = Patrimoine::find($id);
		$patrimoine->delete();

	
		$this->render();
	}




    public function destroy()
    {
        // Order::find($orderId)->delete();

        session()->flash('message','Order deleted successfully!');
    }



}
