<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use Illuminate\Http\Request;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('ventes.index');
    }

    public function rapport()
    {

      //  dump("Je suis en bonne sante");


        return view('ventes.rapport');
        
    }

}
