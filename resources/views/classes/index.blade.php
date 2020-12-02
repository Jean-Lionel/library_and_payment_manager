@extends('layouts.app')

@section('content')

<div class="container-fluid">

	<div class="row">
		<div class="col-md-6">
			<h4>classes</h4>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" placeholder="Recherchez !!!" class="form-control form-control-sm">
			</div>
		</div>

		<div class="col-md-12">
			<a href="{{ route('classes.create') }}" class="btn btn-primary">+</a>
			<table class="table table-sm table-bordered">
				<thead>
					<tr>
						<th>#</th>
						<th>DESCRIPTION</th>
						<th>SECTION</th>
						<th>ACTION</th>
					</tr>
				</thead>

				<tbody>
					@foreach($classes as $classe)
					<tr>
						<td>{{ $classe->id }}</td>
						<td><a href="">{{ $classe->name }}</a></td>
						<td><a href="">{{ $classe->section->name }}</a></td>

						<td class="">

							<div class="d-flex justify-content-around">
								<a href="{{ route('classes.edit',$classe) }}" class="btn btn-info">Modifier</a>


								<form action="{{ route('classes.destroy',$classe) }}" method="post">
									@csrf
									@method('DELETE')

									<button type="submit" onclick="return confirm('Vous êtez sûr ?')" class="btn btn-danger">Supprimer</button>
								</form>
								
							</div>
							


							
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>

			
			
		</div>


		<div class="col-md-12" style="height: 20px; overflow: hidden;">
			{{ $classes->links()}}
		</div>
	</div>

</div>

@stop