@extends('layouts.base')

@section('content')

<div class="container">
	<h5 class="text-center">Modification</h5>
	
	<form action="{{ route('eleves.update', $eleve) }}" method="POST">
		@csrf
		@method('PUT')
		@include('eleves._form',['btn_name' => 'Modifier'])
	</form>
</div>


@stop