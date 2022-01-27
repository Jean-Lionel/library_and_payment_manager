
<style>
	table{
		border-collapse: collapse;
	}
	tr,td,th,table{
		border: 1px solid black;
	}
	td{
		text-align: right;
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

<div>

	<div>
		<div class="header">
			<div class="header-left">
				<p><b>CLASSE : {{  $cours->classe->name ?? ''}}</b></p>
				<p><b>BRANCHE : {{ $cours->name ?? '' }}</b></p>
				<p><b>ANNEE SCOLAIRE : 2021-2022</b></p>
			</div>
			<div class="header-right">
				<p>Le {{ date('d-m-Y') }}</p>
			</div>
		</div>
		<div style="clear: both;"></div>
		<div >
			<h5 class="text-center"><u>Liste des points</u></h5>
		</div>
		<table>
			<thead>
				<tr>
					<td>No</td>
					<th colspan="2">Nom et Prénom</th>
					

					@php
						$max = 0;
					@endphp

					@foreach ($evaluations as $key => $evaluation)
						{{-- expr --}}
							<th>  /{{ $evaluation->ponderation }}</th>
						@php
							$max += $evaluation->ponderation;
						@endphp
					@endforeach
					
					<th>
						TOTAL / {{ $max }}
					</th>
					<th>
						TJ / {{ $cours->ponderation }}
					</th>
				</tr>
				
			</thead>

		<tbody>
			@foreach($listes_points as $key => $eleve)
			<tr>
				<td>{{ ++$key }}</td>
				<td colspan="2" class="text-left">{{ $eleve['nom'] }} {{ $eleve['prenom'] }}</td>
			

				@php
					$total = 0;
				@endphp

				

				@foreach ($evaluations as $key => $evaluation)
					{{-- expr --}}
					<td>{{ $eleve['points'][$key]->point_obtenu ?? "" }}</td> 

					@php
						$total += $eleve['points'][$key]->point_obtenu ?? 0;
					@endphp
				@endforeach
			
				{{-- @foreach ($eleve['points'] as $evaluation)
					<td>{{  $evaluation->point_obtenu}}</td>
					
				@endforeach --}}

				<td>
					{{ $total }}
				</td>

				<td>
					{{ number_format(($total * $cours->ponderation / 
						( $max != 0 ? $max : 1 ))) }}
				</td>
			</tr>
			@endforeach
		</tbody>
		</table>

	</div>
</div>