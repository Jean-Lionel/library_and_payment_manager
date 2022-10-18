<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
   {

    $classes = Classe::latest()->paginate(20);

        // return $Classes;

    return view('classes.index', compact('classes'));
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = \Request::get('id');
       
        $section = Section::find($id) ?? new Section;
        $levels = Level::all();
        $classe = new Classe;

        return view('classes.create',compact('section', 
            'levels','classe'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:classes',
            'level_id' => 'required|numeric'
        ]);

        $level =  Level::find($request->level_id);

        $section_id = $level->section->id;

        Classe::create(array_merge($request->all(), 
            ['section_id' => $section_id])
      );
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classe  $Classe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = Classe::find($id);

        $eleves = Eleve::where('classe_id','=',$id)->paginate();
        return view('classes.view', compact('classe','eleves'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classe  $Classe
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classe = Classe::find($id);
        $levels  = Level::all();

        return view('classes.edit', compact('classe','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classe  $Classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'level_id' => 'required',

        ]);

        $classe = Classe::find($id);
        $level =  Level::find($request->level_id);

        $section_id = $level->section->id;

        $classe->update(array_merge($request->all(), [
            'section_id' => $section_id
        ]));

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classe  $Classe
     * @return \Illuminate\Http\Response
     */
    public function destroy( $value)
    {


     try {

        DB::beginTransaction();
        $classe = Classe::find($value);


        foreach ($classe->eleves as $eleve) {
            $eleve->delete();
        }


        $classe->delete();

        DB::commit();



    } catch (\Exception $e) {

        DB::rollback();
        Session::flash('error' , 'Erreur la suppression echoué');

    }


    return $this->index();
}
}
