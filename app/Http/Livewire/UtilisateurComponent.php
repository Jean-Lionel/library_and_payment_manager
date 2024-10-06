<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use App\Models\Ecole;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class UtilisateurComponent extends Component
{
    public $name ;
    public $password;
    public $telephone;
    public $email;
    public $search;
    public $identifiant;
    public $enseignants;
    public $password_confirmation;
    public $showForm = false;
    public $addRoleToUser = true;
    public $editId = 0;
    public $choosedroles = [];
    public $ecole_id;
    public $image_user;
    use WithFileUploads;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'ecole_id' => ['numeric'],
        'image_user' => ['required', 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']
    ];

    public function render()
    {
        $s = $this->search;

        $users = User::where(function($query) use ($s){

            if(!empty($s)){
                $query->where('name','LIKE', '%'.$s.'%')
                        ->orWhere('email','like','%'.$s.'%');
            }
        })->latest()->paginate();
        $roles = Role::all();
        $ecoles = Ecole::select('id','nom_ecole')->get();

        return view('livewire.utilisateur-component',[
            'users' => $users,
            'roles' => $roles,
            'ecoles' => $ecoles
            ]);
    }

    public function saveUser(){
        $this->validate();

        // $fileName = time().'.'.$this->image_user->extension();
        // $this->image_user->move(public_path('uploads/users'), $fileName);

        $image_user = Carbon::now()->timestamp. '.' .$this->image_user->extension();
        $this->image_user->storeAs('uploads/user', $image_user);

        $data = [
                'name' => $this->name,
                'password' =>  Hash::make($this->password),
                'telephone' => $this->telephone,
                'email' => $this->email,
                'ecole_id' => $this->ecole_id,
                'image_user' => $this->image_user
            ];

        if(!$this->identifiant){

              User::create($data);
              $this->dispatchBrowserEvent('success', ['message' => 'Enregistrement effectué avec succès']);
        }else{

            $user = User::find($this->identifiant);

            $user->update($data );
        }
        $this->reset();
    }

    public function editeUser($user_id){
        $user = User::findOrFail($user_id);
        $this->name = $user->name;
        $this->telephone = $user->telephone;
        $this->email = $user->email;
        $this->identifiant = $user->id;
        $this->showForm = true;
    }

    public function addRoles($user_id){
        $this->editId = $user_id;
        $this->addRoleToUser = true;
        $this->choosedroles = [];
    }

    public function validerRule(){
        $user = User::findOrFail($this->editId);
        $current_roles = array_values($this->choosedroles);
        $user->roles()->sync($current_roles);
        //dd($this->choosedroles);
    }
}
