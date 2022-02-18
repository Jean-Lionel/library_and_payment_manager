<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UtilisateurComponent extends Component
{
    public $name ;
    public $password;
    public $telephone;
    public $email;
    public $search;
    public $identifiant;
    public $password_confirmation;
    public $showForm = false;
    public $addRoleToUser = true;
    public $editId = 0;
    public $choosedroles = [];

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
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

        return view('livewire.utilisateur-component',[
            'users' => $users,
            'roles' => $roles,
            ]);
    }

    public function saveUser(){
        $this->validate();

        $data = [
                'name' => $this->name,
                'password' =>  Hash::make($this->password),
                'telephone' => $this->telephone,
                'email' => $this->email,
            ];

        if(!$this->identifiant){
            
              User::create($data);
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
