@extends('layouts.base')

@section('content')
<div>
        @include('eleves.header.header')

        <div>
            <a href="{{ route('level.create') }}">Ajouter</a>
        </div>

    <table class="table table-sm">
        <thead class="thead-defaultinverse">
            <tr>
                <th>#</th>
                <th>Section</th>
                <th>Nom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($levels as $level)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $level->section->name }}</td>
                <td>{{ $level->name }}</td>
                <td>
                    <a href="{{ route('level.edit', $level) }}">Modifier</a>
                </td>
            </tr>

            @endforeach

        </tbody>
    </table>

</div>
@endsection

