<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presence;
use App\Models\Eleve;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'eleve_id.*' => ['required', 'integer', 'exists:eleves,id'],
            'motif' => 'string|min:3',
            'status_presence' => 'integer'
        ]);
        foreach (json_encode($request->eleve_id) as $key => $value) {
            Presence::create([
                'eleve_id' => $value,
                'user_id' => Auth::user()->id,
            ]);
        }

        if ($request->eleve_id) {
            $present = 1;
            $status_presence->update(['status_presence' => $present]);
        }
        return redirect()->route('eleves.index');
    }

}
