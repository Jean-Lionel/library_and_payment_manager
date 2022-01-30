
<style>
	table{
		border-collapse: collapse;
		width: 100%;
	}
	tr,td,th,table{
		border: 1px solid black;
	}
	td{
		text-align: center;
	}
	.bold{
		font-weight: bold;
	}
	.text-left{
		text-align: left;
	}
	.header-left{
		float: left;
	}
	.header-left p{
		line-height: 0.5;
	}
	.text-center{
		text-align: center;
	}
	.header-right{
		float: right;
	}

</style>




@foreach ($data['palmares'] as $eleve)
{{-- expr --}}
<div>
	<table>
		<thead>
			<tr>
				<th colspan="20" class="text-left">Nom et Prénom : {{ $eleve->fullName }}</th>
			</tr>
			<tr>
				<th colspan="3" class="text-left">
					Classe : {{ $eleve->classe->name }} <br>
					Nombres des élèves : {{$eleve->classe->nombre_eleves() }} 
				</th>
				<th rowspan="2">
					H/S
				</th>
				<th colspan="3">
					MAXIMA
				</th>
				<th colspan="3">
					Premier Trimestre
				</th>
				<th colspan="3">
					Deuxième Trimestre
				</th>
				<th colspan="3">
					Troisième Trimestre 
				</th>
				<th colspan="4">
					Résultats annuels
				</th>
				
			</tr>
			<tr>
				<th>No</th>
				<th colspan="2">Domaines/Disciplines</th>
				<th>T.J </th>
				<th>Ex. </th>
				<th>Total </th>
				<th>T.J </th>
				<th>Ex. </th>
				<th>Total </th>
				<th>T.J </th>
				<th>Ex. </th>
				<th>Total </th>
				<th>T.J </th>
				<th>Ex. </th>
				<th>Total </th>
				<th>MAX </th>
				<th>TOT  </th>
				<th>%  </th>
				<th>A.P </th>
			</tr>
		</thead>

		<tbody>
			@foreach ($eleve->courses_listes as $key => 
				$coursListe)
				{{-- expr --}}
				<tr>
					<td rowspan="{{ count($coursListe) }}">{{ ++$loop->index }}  </td>
					<td rowspan="{{ count($coursListe) }}">
						{{ array_keys($coursListe)[0] }}
					</td>
				</tr>

				@foreach ($coursListe as $cours)
				@foreach ($cours as $course)
				<tr>
					<td></td>
					<td></td>
					<td>{{ $course['name'] }}</td>
					<td>
						{{ $course['cours']->credit }}
					</td>
					<td>{{ $course['cours']->ponderation }}</td>
					<td>{{ $course['cours']->ponderation }}</td>

					<td>
						{{ $course['poderation'] }}
					</td>
					{{-- PREMIER TRIMESTRE --}}
					<td>{{ $course['interrogation'] }}</td>
					<td>{{ $course['examen'] }}</td>
					<td>{{ $course['total'] }}</td>

					{{-- II TRIMESTRE --}}
					<td></td>
					<td></td>
					<td></td>
					{{-- III TRIMESTRE --}}
					<td></td>
					<td></td>
					<td></td>
					{{--  --}}

					<td class="bold">
						{{ $course['cours']->ponderationTotal * 3 }}
					</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@endforeach
				@endforeach
				@endforeach

				<tr>
					<th>TOTAL</th>
				</tr>
				<tr>
					<th>Pourcentage</th>
				</tr>
				<tr>
					<th>Place</th>
				</tr>
				<tr>
					<th>Education Morale</th>
				</tr>
				<tr>
					<th>Signatures</th>
				</tr>
			</tbody>
		</table>
	</div>

	@endforeach
