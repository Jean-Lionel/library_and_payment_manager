@extends('layouts.base')

@section('content')
    <div>
            @include('eleves.header.header')
            <form action="{{ route('level.update', $level) }}" method="post">
                @method('PUT')
                @csrf
                @include('level._form', ["message" => "Modifier"])
            </form>
    </div>
@endsection

