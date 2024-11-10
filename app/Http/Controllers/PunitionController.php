<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PunitionController extends Controller
{
    public function create($id){
        return view('punitions.create' , compact('id'));
    }
}
