@extends('layouts.app')

@section('content')

<div class="container">
	<h5 class="text-center">Modification</h5>
	
	<form action="{{ route('classes.update', $classe) }}" method="POST">
		@csrf
		@method('PUT')
		@include('classes._form',['btn_name' => 'Modifier'])
	</form>
</div>


@stop