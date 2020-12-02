@extends('layouts.app')

@section('content')

<div class="container">
	<h5 class="text-center">Ajouter une section</h5>
	
	<form action="{{ route('sections.store') }}" method="POST">
		@csrf
		@method('POST')
		@include('sections._form',['btn_name' => 'Enregistrer'])
	</form>
</div>


@stop