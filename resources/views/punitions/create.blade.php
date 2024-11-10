@extends('layouts.base')

@section('content')
    @livewire('punition.create', [
        'eleve_id' => $id
        ])
@stop