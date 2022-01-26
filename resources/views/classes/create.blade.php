@extends('layouts.base')

@section('content')
<div>
	@include('eleves.header.header')
</div>

<div class="container">
	<h5 class="text-center">Ajouter une section</h5>
	
	<form action="{{ route('classes.store') }}" method="POST">
		@csrf
		@method('POST')
		@include('classes._form',['btn_name' => 'Enregistrer'])
	</form>
</div>


@stop