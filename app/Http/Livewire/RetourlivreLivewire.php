<?php

namespace App\Http\Livewire;

use App\Models\DetailEmprunt;
use App\Models\Eleve;
use App\Models\Emprut;
use App\Models\RetourLivre;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class RetourlivreLivewire extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $searchName;
    public $selectStudent;
    public $numberLivre;

    public $detailEmprunt;

    public function mount()
    {

    }

    public function render()
    {
    	$emprus_non_remis_ids = Emprut::where('etat','=','NON REMIS')->get();

        $searchName = '%'.$this->searchName.'%';

        $ids = $emprus_non_remis_ids->map->eleve_id;

        $eleves = Eleve::whereIn('id',$ids)
        ->where(function($query) use($searchName){

            $query->where('first_name','like',$searchName)
            ->orWhere('last_name','like', $searchName);

        })
        ->paginate(5);
        return view(
        	'livewire.retourlivre-livewire',
        	[
        		'eleves' => $eleves
        	]

        );
    }


    public function searchStudent($id)
    {
        $this->selectStudent =  Eleve::find($id);
        $this->numberLivre = null;
    }

    public function validerRetour($id){

        $this->detailEmprunt = Emprut::find($id);

    }

    public function validerRemet(){

        try {

          DB::beginTransaction();
          $emprut_id = null;
          foreach ($this->numberLivre as $key => $value) {
            # code...
            # Rechercher les livres 
            # Ajouter livre dans l'armoir
            $detailEmprut = DetailEmprunt::find($key);

            $emprut_id = $detailEmprut->emprut_id;

            $detailEmprut->livreRemet += $value;

            if($detailEmprut->livreRemet == $detailEmprut->quantite){
                $detailEmprut->etat = 'REMIS';
            }

            //Ajouter le livre dans la bibliotheque
            $livre = $detailEmprut->book;

            if($livre->nombre_livre_retire  >=$value ){
             $livre->nombre_livre_retire -= $value;

             $livre->save();

             RetourLivre::create([
                'livre_title' =>  $livre->title,
                'quantite' => $value,
                'livre_id' => $livre->id,
                'detail_emprunt_id' => $detailEmprut->id,

            ]);

         }else{
            throw new Exception("Error Processing Request", 1);



        }


        $detailEmprut->save();


    }

    $this->validateRemiseLivre($emprut_id );
    $this->detailEmprunt = null;

    $this->render();

    DB::commit();

} catch (\Exception $e) {
    DB::rollback();

    dump($e->getMessage());

}


}


private function validateRemiseLivre($id){

    $emprut = Emprut::find($id);

    $chek  = true;

    foreach ($emprut->detailsBooks as  $value){

        if($value->etat != 'REMIS')
            $chek = false;

        
    }

    if($chek){
        $emprut->etat = 'REMIS';
        $emprut->save();
    }

}
}
