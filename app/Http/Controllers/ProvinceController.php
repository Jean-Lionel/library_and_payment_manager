<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use Illuminate\Support\Facades\Auth;

class ProvinceController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        Province::create([
            'nom_province' => $request->nom_province,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->back();
    }
}
