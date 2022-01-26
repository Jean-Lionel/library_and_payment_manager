@extends('layouts.base')

@section('content')
    <div>
            @include('eleves.header.header')
            <form action="{{ route('level.store') }}" method="post">
                @method('POST')
                @csrf
                @include('level._form', ["message" => "Enregistrer"])
            </form>
    </div>
@endsection

