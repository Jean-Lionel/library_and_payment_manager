
<style>
	table{
		border-collapse: collapse;
	}
	tr,td,th,table{
		border: 1px solid black;
	}
</style>

<div>

	<div>
		<table>
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>TJ 1</th>
					<th>TJ 1</th>
					<th>TJ 2</th>
				</tr>
				
			</thead>

		<tbody>
			@foreach($listes_points as $eleve)
			<tr>
				<td>{{ $eleve['nom'] }}</td>
				<td>{{ $eleve['prenom'] }}</td>
			
				@foreach ($eleve['points'] as $evaluation)
					<td>{{  $evaluation->point_obtenu}}</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>
		</table>

	</div>
</div>