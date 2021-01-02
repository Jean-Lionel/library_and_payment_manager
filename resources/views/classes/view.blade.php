@extends('layouts.app')


@section('content')

<div class="row">
	<div class="col-md-6">
		<h2>{{ $classe->name }}</h2>
	</div>
	<div class="col-md-6">
		<a href="{{ route('eleves.create', ['id' => $classe]) }}" class="btn btn-primary btn-block btn-sm table-responsive">Ajouter un élève</a>
	</div>
	<div class="col-md-12">
		<table class="table table-bordered table-sm">
			<tr>
				<th>#</th>
				<th>COMPTE</th>
				<th>NOM</th>
				<th>PRENOM</th>
				<th>Action</th>
			</tr>

			@foreach($classe->eleves as $eleve)
			<tr>
				<td>{{ $eleve->id }}</td>
				<td>{{ $eleve->compte->name ?? "" }}</td>
				<td>{{ $eleve->first_name }}</td>
				<td>{{ $eleve->last_name }}</td>
				<td class="d-flex ">
					<a href="{{ route('eleves.edit', $eleve) }}" class="btn-sm btn btn-info mr-2">Modifier</a>

					<form action="{{ route('eleves.destroy', $eleve) }}" method="POST">
						@csrf
						@method('DELETE')

						<button class="btn btn-danger" onclick="return confirm('Etez-vous sûr ?')">Supprimer</button>
					</form>
				</td>
			</tr>

			@endforeach
			
		</table>
	</div>
</div>


@stop