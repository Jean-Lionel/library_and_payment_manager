<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Territoire;
use Illuminate\Support\Facades\Auth;

class TerritoireController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        Territoire::create([
            'nom_territoire' => $request->nom_territoire,
            'province_id' => $request->province_id
        ]);
        return redirect()->back();
    }
}
