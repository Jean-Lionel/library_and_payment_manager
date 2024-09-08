<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ecole;
use App\Models\Eleve;

class AccueilController extends Controller
{
    public function index()
    {
        $ecoles = Ecole::latest()->paginate(10);
        return view('welcome', ['ecoles' => $ecoles]);
    }
}
