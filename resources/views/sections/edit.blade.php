@extends('layouts.app')

@section('content')

<div class="container">
	<h5 class="text-center">Modification</h5>
	
	<form action="{{ route('sections.update', $section) }}" method="POST">
		@csrf
		@method('PUT')
		@include('sections._form',['btn_name' => 'Modifier'])
	</form>
</div>


@stop