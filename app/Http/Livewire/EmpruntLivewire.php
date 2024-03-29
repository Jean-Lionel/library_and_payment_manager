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
    public $nbre_jour;

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
        if(strlen($search) >= 1){
        $readers = Eleve::where(function($query) use($search){
                $query->where('first_name', 'like', '%'.$search.'%')
                      ->orWhere('last_name','like','%'.$search.'%' )
                      ->orWhere('id', 'like', '%'.$search);
        })->get();

        }
       
        $books =  Book::where('title', 'like', '%'. $this->book_title.'%')->latest()->paginate(5);

        return view('livewire.emprunt-livewire',
            [
                'readers' =>  $readers,
                'livres' =>   $books

            ]
        );
    }

    public function searchReader(){
         dd(Cart::content());
    }

    public function closeSearch(){
         $this->empreteur = null;
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

    protected $rules = [
        'nbre_jour' => 'required|min:0|max:100'
    ];

    // public function updatedNbreJour($val){
    //     $this->validateOnly($val);
    // }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function validerRetrait()
    {
        //Voir le commandeur des livres
        //Voir que les n'ont pas été retirer par les autres
        //Demander qu'on va valider le retrait
        //Enlever le livre dans le bibliotheque
        //Enregistre les information
       if($this->nbre_jour > 100 or $this->nbre_jour <0)
       {
        session()->flash('error',"Le nombre de jour doit être  entre 1 et 100 ");
        return;
       }

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
        

        if($this->noLongerStock()){
              session()->flash('error',"Tout les livres choisissent ne sont pas disponible dans la bibliotheque ");
              return;  
        }

 
        try {

            DB::beginTransaction();
            $dateRetrait = Carbon::now();
            $dateRetour = $dateRetrait->addDays($this->nbre_jour);

            $emprut = Emprut::create([
                'eleve_id' => $this->empreteur->id,
                'professeur_id' => 1,
                'lecteur_id' => 1,
                'type_lecteur' => $this->type_lecteur,
                'detail_emprunt' => json_encode($this->extractCart()),
                'date_retrait' =>  Carbon::now() ,
                'date_retour' => $dateRetour,
                'etat' => 'NON REMIS',

            ]);

             $this->storeDetailBook( $emprut->id);
             //Mise a jour du stock
              $this->stockUpdated();
              $this->resetinput();
              session()->flash('message'," Opération réussi avec succès");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            dump($e->getMessage()); 
        }
    }

    private function storeDetailBook($emprut_id)
    {
        foreach (Cart::content() as $item) {
            DetailEmprunt::create([
                'emprut_id' => $emprut_id,
                'book_id' => $item->id,
                'quantite' => $item->qty,
                'etat' => 'NON REMIS',
                'livreRemet' => 0
            ]);
        }
    }

    private function extractCart(){

        $products = [];
        foreach (Cart::content() as $item) {
            // dump($item);
            $products['books'][] = [
                'id' => $item->id,
                'name' => $item->name,
                'quantite' => $item->qty,
                
            ];
        }
        $products['lecteur'] = $this->empreteur->toArray();
        return $products;
    }


    private function resetinput(){
        Cart::destroy();
        $this->empreteur = null;
        $this->nbre_jour = "";
        $this->searchKey = "";
    }



    private function noLongerStock()
    {
        foreach (Cart::content() as $item) {
            $product = Book::find($item->id);

            $qty = $product->nombre_livre_retire + $item->qty;
            if( $qty > $product->nombre_exemplaire  )
                return true;
        }
        return false;
    }

    private function stockUpdated()
    {
        foreach (Cart::content() as $item) {
            $book = Book::find($item->id);
            $book->update(
                ['nombre_livre_retire' => $book->nombre_livre_retire + $item->qty]);
        }
    }
    //Retrait du livre
    //Rechercher le livre
    //Trouver le livre 
    //Verfier si le livre est disponible
    //Si le livre existe Accepter le retrait 
    //Si non Refus du retrait
    //Diminuer la quantite en stock
    //
}
