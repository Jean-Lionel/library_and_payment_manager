<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NotificationSweetAlert extends Component
{

    protected $listeners = ['remove'];
    /**

     * Write code on Method

     *

     * @return response()

     */

    public function render()

    {
        return view('livewire.notification-sweet-alert')->extends('layouts.hello');

    }

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function alertSuccess()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  
            'message' => 'User Created Successfully!', 
            'text' => 'It will list on users table soon.'

        ]);

    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function alertConfirm()

    {

        $this->dispatchBrowserEvent('swal:confirm', [

            'type' => 'warning',  

            'message' => 'Are you sure?', 

            'text' => 'If deleted, you will not be able to recover this imaginary file!'

        ]);

    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function remove()

    {

        /* Write Delete Logic */

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',  

            'message' => 'User Delete Successfully!', 

            'text' => 'It will not list on users table soon.'

        ]);

    }
}
