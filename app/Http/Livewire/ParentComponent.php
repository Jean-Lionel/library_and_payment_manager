<?php

namespace App\Http\Livewire;

use App\Models\Eleve;
use App\Models\EleveParent;
use App\Models\Role;
use App\Models\User;
use DB;
use Illuminate\Support\Str;
use Livewire\Component;

class ParentComponent extends Component
{
    public $firstName;
    public $lastName;
    public $email;
    public $telephone;
    public $identification;
    public $address;
    public $showForm = false;
    public $selectedParent = 0;
    public $search;

    public function render()
    {
        $s = $this->search;
        $parents = EleveParent::where(function ($query) use($s){

            if(!empty($s)){
                $query->where('firstName','like','%'.$s.'%')
                     ->orWhere('lastName','like','%'.$s.'%')
                     ->orWhere('email','like','%'.$s.'%')
                     ->orWhere('telephone','like','%'.$s.'%');
            }

        } )->latest()->paginate();

        return view('livewire.parent-component',[
            'parents' => $parents
        ])->extends('layouts.base');
    }

    protected $rules = [
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'unique:eleve_parents,id',
    ];

    public function saveParent(){
        $this->validate();

        $data = [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'address' => $this->address,
            'created_by' => auth()->user()->id,
        ];
          //dd($this->identification);
        try {
            DB::beginTransaction();
            if ($this->identification) {
            // code...
                $user = User::update([
                    'name' => $this->firstName.' '.$this->lastName,
                    'email' => $this->email,
                    'telephone' => $this->telephone,
                    'email_verified_at' => now(),
                    // 12345678 Mot de passe par defaut
                    'password' => bcrypt('12345678'), 
                    'remember_token' => Str::random(10),
                ]);
                EleveParent::find($this->identification)->update($data);
            }else{
                $user = User::create([
                    'name' => $this->firstName.' '.$this->lastName,
                    'email' => $this->email,
                    'telephone' => $this->telephone,
                    'email_verified_at' => now(),
                    'password' => bcrypt('12345678'), // 12345678 Mot de passe par defaut
                    'remember_token' => Str::random(10),
                ]);
                $data['user_id'] = $user->id;

                $role = Role::where('name','PARENT')->first();

                $user->roles()->sync([$role->id]);
                EleveParent::create($data);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            
        }
        $this->reset();
    }

    public function modifierParent($id){
        $parent = EleveParent::findOrFail($id);
        $this->firstName = $parent->firstName;
        $this->lastName = $parent->lastName;
        $this->email = $parent->email;
        $this->telephone = $parent->telephone;
        $this->address = $parent->address;
        $this->identification = $parent->id;
        $this->showForm = true;
    }

    public function choosedParent($id){
        $this->selectedParent = $id;
    }

    public function supprimerEnfant($id){
        $eleve = Eleve::findOrFail($id);
        $eleve->parent_id =  NULL;
        $eleve->save();
    }
}
