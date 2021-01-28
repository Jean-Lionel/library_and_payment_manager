<?php

namespace App\Http\Livewire;

use App\Models\Auteur;
use App\Models\Book;
use App\Models\Classement;
use Livewire\Component;

class BookLivewire extends Component
{

	public $title;
	public $isbn;
	public $nombre_exemplaire;
	public $edition;
	public $auteur_id;
	public $classement_id;
	public $classements;
	public $authors;

	protected $rules =
	[
		'title' => 'required',
		'nombre_exemplaire' => 'required',
		'auteur_id' => 'required',
		'edition' => 'required',
		'classement_id' => 'required',

	];

	public function mount()
	{
		$this->classements = Classement::all();
		$this->authors = Auteur::all();
	}
	
    public function render()
    {
    	$books = Book::latest()->paginate();

        return view('livewire.book-livewire',['books'=>$books]);
    }

    public function saveBook()
    {
    	$this->validate();

    	Book::create([
    		
    		'title' => $this->title,
    		'nombre_exemplaire' => $this->nombre_exemplaire,
    		'auteur_id' => $this->auteur_id,
    		'classement_id' => $this->classement_id,
    		'edition' => $this->edition,
    		'isbn' => $this->isbn

    	]);

    	$this->reset();

    }
}
