@extends('layouts.base')

@section('content')

<div class="container">
	<h5 class="text-center">Ajouter un élève en <b> {{ $classe->name ?? "" }} </b></h5>

	
	<form action="{{ route('eleves.store') }}" method="POST">
		@csrf
		@method('POST')
		@include('eleves._form',['btn_name' => 'Enregistrer'])
	</form>
</div>


@stop