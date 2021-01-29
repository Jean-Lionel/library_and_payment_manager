<?php

namespace App\Http\Livewire;

use App\Models\Book;
use App\Models\Classement;
use App\Models\DetailEmprunt;
use App\Models\Eleve;
use App\Models\Emprut;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EmpruntLivewire extends Component
{
    
    public $student;
    public $eleve_id;
    public $type_lecteur;
    public $category;
    public $categories;
    public $searchKey;
    public $empreteur;
    public $book_title;
    public $choosedBook;

    //Trois type de personnes peuvent empruter les livres
    //Proffesseur , Les eleves , Les particuliers
    // professeur_id
    // lecteur_id
    // type_lecteur
    
    public function mount(){
        Cart::destroy();

        $this->categories = Classement::all();

        $this->type_lecteur = 'eleves';
    }

    public function render()
    {
        // $readers = DB::table($this->type_lecteur)->get();
        
        $search = $this->searchKey;
        $readers = collect();
        if(strlen($search) > 2){
        $readers = Eleve::where(function($query) use($search){
                $query->where('first_name', 'like', '%'.$search.'%')
                      ->orWhere('last_name','like','%'.$search.'%' )
                      ->orWhere('id', 'like', '%'.$search);

        })->get();

        }
       

        $books =  Book::where('title', 'like', '%'. $this->book_title.'%')->latest()->paginate();


        return view('livewire.emprunt-livewire',
            [
                'readers' =>  $readers,
                'livres' =>   $books

            ]
        );
    }


    public function validerEmprut()
    {
       dd(Cart::content());
        
    }

    public function ajouterAuPanier($id)
    {

        $book = Book::find($id);
        Cart::add($book->id,  $book->title, 1,  0);
    }

    public function afficherLivre($id)
    {
        $this->choosedBook = Book::find($id);
    }

    public function choisirEleve($lecteur)
    {
        $eleve = Eleve::find($lecteur['id']);

        $this->empreteur = $eleve;
    }

    public function removeItem($rowId){
        Cart::remove($rowId);

        //dump("Je suis cool");
    }

    public function validerRetrait()
    {
        //Voir le commandeur des livres
        //Voir que les n'ont pas été retirer par les autres
        //Demander qu'on va valider le retrait
        //Enlever le livre dans le bibliotheque
        //Enregistre les information
        
      

        if(!$this->empreteur )
        {
            session()->flash('error',"Choissisez l'empreteur ??");

            return;
        }

        if(Cart::content()->count() < 1)
        {
             session()->flash('error',"Aucun livre n'a été choisit");

            return;
        }

        // eleve_id`, `professeur_id`, `lecteur_id`, `type_lecteur`, `date_retrait`, `date_retour`, `user_id`, `created_at`, `updated_at`
        // 
    

        

        try {

            DB::beginTransaction();

            $emprut = Emprut::create([
                'eleve_id' => 1,
                'professeur_id' => 1,
                'lecteur_id' => 1,
                'type_lecteur' => 1,
                'date_retrait' => Carbon::now(),
                'date_retour' => Carbon::now(),

            ]);

            DetailEmprunt::create([
                'emprut_id' => $emprut->id,
                'book_id' => 1
            ]);
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dump($e->getMessage());
            
        }
    }
}
