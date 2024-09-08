<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ecole;
use App\Models\Province;
use App\Models\Territoire;
use Illuminate\Support\Facades\Auth;

class EcoleController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        $provinces = Province::select('id', 'nom_province')->get();
        $territoires = Territoire::select('id', 'nom_territoire')->get();
       return view("ecoles.create", compact('provinces','territoires'));
    }

    public function store(Request $request)
    {
        Ecole::create([
            'nom_ecole' => $request->nom_ecole,
            'adresse_ecole' => $request->adresse_ecole,
            'arreter_ministeriel' => $request->arreter_ministeriel,
            'type_ecole' => $request->type_ecole,
            'categorie_ecole' => $request->categorie_ecole,
            'niveau_ecole' => $request->niveau_ecole,
            'date_creation' => $request->date_creation,
            'vacation' => $request->vacation,
            'user_id' => Auth::user()->id,
            'province_id' => $request->province_id,
            'territoire_id' => $request->territoire_id
        ]);

        return redirect()->back();
    }

    public function update()
    {

    }
}
