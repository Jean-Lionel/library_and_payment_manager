<?php

namespace App\Http\Controllers;

use App\Models\Patrimoine;
use Illuminate\Http\Request;

class PatrimoineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('patrimoines.index');
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
     * @param  \App\Models\Patrimoine  $patrimoine
     * @return \Illuminate\Http\Response
     */
    public function show(Patrimoine $patrimoine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patrimoine  $patrimoine
     * @return \Illuminate\Http\Response
     */
    public function edit(Patrimoine $patrimoine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patrimoine  $patrimoine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patrimoine $patrimoine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patrimoine  $patrimoine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patrimoine $patrimoine)
    {
        //
    }
}
