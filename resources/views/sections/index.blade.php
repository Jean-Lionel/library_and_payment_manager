@extends('layouts.base')

@section('content')

<div class="container-fluid">

	<div class="row">
		<div class="col-md-6">
			<h4>Sections</h4>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input type="text" placeholder="Recherchez !!!" class="form-control form-control-sm">
			</div>
		</div>

		<div class="col-md-12">
			<a href="{{ route('sections.create') }}" class="btn btn-primary">+</a>
			<table class="table table-sm table-bordered">
				<thead>
					<tr>
						<th>Numéro</th>
						<th>DESCRIPTION</th>
						<th>ACTION</th>
					</tr>
				</thead>

				<tbody>
					@foreach($sections as $key =>$section)
					<tr>
						<td>{{ $key+1 }}</td>
						<td><a href="{{ route('sections.show',$section) }}">{{ $section->name }}</a></td>

						<td class="">

							<div class="d-flex justify-content-around">
								<a href="{{ route('sections.show',$section) }}" class="btn btn-sm btn-info">Afficher les élèves</a>

								<a href="{{ route('sections.edit',$section) }}" class="btn btn-sm btn-info">Modifier</a>

								<form action="{{ route('sections.destroy',$section) }}" method="post">
									@csrf
									@method('DELETE')

									<button type="submit" onclick="return confirm('Voulez-vous  supprimer ?')" class="btn btn-sm btn-danger">Supprimer</button>
								</form>
								
							</div>
							


							
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>

			
			
		</div>


		<div class="col-md-12" style="height: 20px; overflow: hidden;">
			{{ $sections->links()}}
		</div>
	</div>

</div>

@stop