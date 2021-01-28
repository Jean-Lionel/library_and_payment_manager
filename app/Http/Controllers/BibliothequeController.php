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
}