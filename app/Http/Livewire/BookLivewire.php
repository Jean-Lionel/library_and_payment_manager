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
	public $identification;
	public $nombre_exemplaire;
	public $edition;
	public $auteur_id;
	public $classement_id;
	public $classements;
	public $authors;
	public $showForm = false;

	protected $rules =
	[
		'title' => 'required',
		'nombre_exemplaire' => 'required|numeric|min:0',
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
    	$books = Book::latest()->paginate(10);

    	$this->classements = Classement::all();
		$this->authors = Auteur::all();

        return view('livewire.book-livewire',['books'=>$books]);
    }

    public function saveBook()
    {
    	$this->validate();

    	$data = [
    		'title' => $this->title,
    		'nombre_exemplaire' => $this->nombre_exemplaire,
    		'auteur_id' => $this->auteur_id,
    		'classement_id' => $this->classement_id,
    		'edition' => $this->edition,
    		'isbn' => $this->isbn

    	];

    	if($this->identification){
    		$book = Book::where('id', $this->identification)->firstOrFail();
    		$book->update($data);
    	}else{
    		Book::create($data);
    	}
    	$this->reset();

    }

    public function updateBook($id)
    {

    	$book = Book::find($id);
    	$this->identification = $book->id;
    	$this->title = $book->title;
    	$this->nombre_exemplaire = $book->nombre_exemplaire;
    	$this->classement_id = $book->classement_id;
    	$this->edition = $book->edition;
    	$this->isbn = $book->isbn;
    	$this->auteur_id = $book->auteur_id;

    	$this->showForm = true;

    }

    public function supprimerLivre($id)
    {
        $book = Book::find($id)->delete();

    }
}
