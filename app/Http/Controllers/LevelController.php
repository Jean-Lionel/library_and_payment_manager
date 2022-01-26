<?php

namespace App\Http\Controllers;

use App\Http\Requests\LevelStoreRequest;
use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $levels = Level::paginate();
        return view('level.index', compact('levels'));
    }

    /**
     * @param \App\Http\Requests\LevelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelStoreRequest $request)
    {
        $level = Level::create($request->validated());

        $request->session()->flash('level.name', $level->name);

        return redirect()->route('level.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sections = Section::all();
        return view('level.create',compact('sections'));
    }
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Level $level
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Level $level)
    {
        $level = Level::find($level);

        return view('level.edit', compact('level'));
    }
}
