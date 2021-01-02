<?php

namespace App\Http\Controllers;

use App\Models\Paiment;
use Illuminate\Http\Request;

class PaimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paiments = Paiment::sortable()->latest()->paginate();

   

        return view('paiements.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paiment  $paiment
     * @return \Illuminate\Http\Response
     */
    public function show(Paiment $paiment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paiment  $paiment
     * @return \Illuminate\Http\Response
     */
    public function edit(Paiment $paiment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paiment  $paiment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paiment $paiment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paiment  $paiment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paiment $paiment)
    {
        //
    }
}
