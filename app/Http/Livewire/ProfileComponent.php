<?php

namespace App\Http\Livewire;

use App\Models\EleveParent;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ProfileComponent extends Component
{
    public $oldPassword;
    public $currentPassword;
    public $newPassword;
    public $showForm = false;

    public function render()
    {
        $user = auth()->user();
        $parent = EleveParent::where('user_id',$user->id)->first();
        $eleves = [];
        if ($user->isParent()) {
            // code...
            $eleves = $parent->enfant;
        }

        return view('livewire.profile-component',[
            'user' => $user,
            'parent' => $parent,
            'eleves' => $eleves
        ]);
    }

    public function updatePassword(){

        if (!(Hash::check($this->oldPassword, auth()->user()->password))) {
            // The passwords matches
            session()->flash("error","Your current password does not matches with the password.");

        }else{

            if(strcmp($this->currentPassword, $this->newPassword)){
            // Current password and new password same
                session()->flash("error","New Password cannot be same as your current password.");
            }else{
             $user = auth()->user();
             $user->password = bcrypt($this->currentPassword);
             $user->save();
             session()->flash("success","Password successfully changed!");
             $this->showForm = false;
         }
       }

       /* $validatedData = $request->validate([
            'oldPassword' => 'required',
            'currentPassword' => 'required|string|min:8|confirmed',
        ]);*/

        //Change Password
        

       // dump($this->oldPassword, $this->currentPassword, $this->newPassword);
        
    }
}
