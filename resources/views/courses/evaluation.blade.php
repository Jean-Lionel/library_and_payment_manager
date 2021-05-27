@extends('layouts.base')

@section('content')

<div>
	@include('courses.header')
	<livewire:evaluation-component />
</div>


@stop