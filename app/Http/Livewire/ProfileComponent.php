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

    public function render()
    {
        $user = auth()->user();
        $parent = EleveParent::where('user_id',$user->id)->firstOrFail();

        return view('livewire.profile-component',[
            'user' => $user,
            'parent' => $parent,
        ]);
    }

    public function updatePassword(){

        if (!(Hash::check($this->oldPassword, auth()->user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password successfully changed!");

       // dump($this->oldPassword, $this->currentPassword, $this->newPassword);
        
    }
}
