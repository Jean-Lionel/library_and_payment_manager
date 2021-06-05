@extends('layouts.base')

@section('content')

<div>
	@include('courses.header')
	<livewire:course-category-component />
</div>


@stop