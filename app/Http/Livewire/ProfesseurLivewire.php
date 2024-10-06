<?php

namespace App\Http\Livewire;

use App\Models\Professeur;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class ProfesseurLivewire extends Component
{
  use WithPagination;

  protected $paginationTheme ='bootstrap';
  public $name;
  public $telephone;
  public $search;
  public $email;
  public $identification;
  public $showForm = false;
  public $errorMessage;


  public function render()
  {
   $proffesseurs = Professeur::latest()
   ->where('name' , 'like', '%'.$this->search.'%')->paginate();

   return view(
    'livewire.professeur-livewire',
    [ 'proffesseurs' => $proffesseurs ]
);
}

public $rules = [
   'name' => 'required',
   'telephone' => 'required|min:8',
   'email' => 'required|email|unique:professeurs',
];

public function saveProffesseur()
{
   $this->validate();

   if($this->identification){

    Professeur::find($this->identification)->update([
        'name' => $this->name,
        'telephone' => $this->telephone,
        'email' => $this->email,

    ]);


}else{

   Professeur::create([
      'name' => $this->name,
      'telephone' => $this->telephone,
      'email' => $this->email,

  ]);
  $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);
}

$this->showForm = false;

$this->reset();

}

public function updateProfesseur($id)
{
    $prof = Professeur::find($id);

    $this->name = $prof->name;
    $this->telephone = $prof->telephone;
    $this->identification = $prof->id;
    $this->email = $prof->email;
    $this->showForm = true;
}

public function setAsUser($id){
    $prof = Professeur::find($id);
        // Le système generer par defaut un Mot de passe qui sera modifier par le professeur lui même
    $data = [
        'name' => $prof->name,
        'password' =>  Hash::make('12345678'),
        'telephone' => $prof->telephone,
        'email' => $prof->email,
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ];
    if ( $prof->user_id != null) {
            // code...
        session()->flash('message', "L'utilisateur existe déjà");
    }else{
        try {
            DB::beginTransaction();
            $user = User::create($data);
            $user->roles()->sync([3]);
            $prof->user_id =  $user->id;
            $prof->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
           // dd($e->getMessage());
            //$this->errorMessage = $e->getMessage();
            session()->flash('message', "Vérifier les informations du professeur");

        }

    }

}
}
