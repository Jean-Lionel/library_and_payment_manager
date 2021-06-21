<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AddRoleComponent extends Component
{
    public $user_id;
    
    public function render()
    {
        return view('livewire.add-role-component');
    }
}
