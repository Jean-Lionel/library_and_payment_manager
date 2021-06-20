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
    public $password_confirmation;
    public $showForm = false;
    public $addRoleToUser = true;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    public function render()
    {
        $users = User::latest()->paginate();
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

        User::create($data);
        $this->reset();
    }

    public function editeUser($user_id){

    }

    public function addRoles($user_id){
        $this->addRoleToUser = true;
    }
}
