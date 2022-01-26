@extends('layouts.base')

@section('content')

<div>
	@include('eleves.header.header')
	<livewire:eleve-livewire></livewire:eleve-livewire>
</div>

@stop