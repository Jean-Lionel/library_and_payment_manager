@extends('layouts.base')


@section('content')


<div>
	

	<div class="row">
	
		
			<div class="col-md-9">
				<h4 classe="text-center"> {{ $section->name }}</h4>
			</div>

			<div class="col-md-3">
				<a href="{{ route('classes.create', ['id' => $section]) }}" class="btn btn-primary btn-block btn-sm">Ajouter une classe</a>
			</div>
		

		<div class="col-md-12">

			<table class="table table-sm table-dark table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>DESIGNATION</th>
						<th>ACTION</th>
					</tr>
				</thead>

				<tbody>
					@foreach($section->classes as $key=> $classe)
					<tr>
						<td>{{ $key +1 }}</td>
						<td>{{ $classe->name }}</td>
						<td><a href="{{ route('classes.show',$classe) }}">Afficher les classes</a></td>
					</tr>

					@endforeach
				</tbody>
			</table>

			
			
		</div>
	</div>
</div>


@stop