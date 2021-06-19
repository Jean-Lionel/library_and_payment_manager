<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UtilisateurComponent extends Component
{
    public $name ;
    public $password;
    public $telephone;
    public $email;
    public $password_confirmation;
    public $showForm = false;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    public function render()
    {
        $users = User::latest()->paginate();
        return view('livewire.utilisateur-component',[
            'users' => $users
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

        User::create( $data);
        $this->reset();
    }
}
