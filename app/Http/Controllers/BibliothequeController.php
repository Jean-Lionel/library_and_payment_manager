<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BibliothequeController extends Controller
{
	public function index()
	{
		return view('bibliotheque.index');
	}

	public function etageres()
	{
		return view('bibliotheque.etageres');
	}

	public function books()
	{
		return view('bibliotheque.books');
	}

	public function classements()
	{
		return view('bibliotheque.classements');
	}

	public function etagers()
	{
		return view('bibliotheque.etagers');
	}

	public function professeurs(){
		return view('bibliotheque.professeurs');
	}

	public function lecteurs()
	{
		return view('bibliotheque.lecteurs');
	}

	public function empruts()
	{
		return view('bibliotheque.empruts');
	}

	public function history()
	{
		return view('bibliotheque.history');
	}
}