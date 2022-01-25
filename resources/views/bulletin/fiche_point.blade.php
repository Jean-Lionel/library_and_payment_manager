
<style>
	table{
		border-collapse: collapse;
		width: 100%;
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
	<div class="header">
			<div class="header-left">
				<p><b>CLASSE : {{  $cours->classe->name}}</b></p>
				<p><b>BRANCHE : {{ $cours->name }}</b></p>
				<p><b>ANNEE SCOLAIRE : 2021-2022</b></p>
			</div>
			<div class="header-right">
				<p>Le {{ date('d-m-Y') }}</p>
			</div>
	</div>

	<div style="clear: both;"></div>
	
	<div>
		<h5 class="text-center"><u>FICHE DE POINTS</u></h5>
		<table>
			<thead>
				<tr>
					<th rowspan="2">No</th>
					<th rowspan="2">Nom et Prénom</th>
					<th rowspan="2">Sexe</th>
					<th colspan="4">MAXIMA</th>
					<th colspan="4">Premier Trimestre</th>
					<th colspan="4">Deuxième Trimestre</th>
					<th colspan="4">Troisième Trimestre</th>
					<th colspan="3">Résultats annuels</th>

				</tr>
				<tr>
					@for ($i = 0; $i < 4 ; $i++)
						<th>TJ </th>
						<th>COM.  </th>
						<th>RES.  </th>
						<th>TOT  </th>
					@endfor
					<th> MAX.AN </th>
					<th> TOT.AN </th>
					<th> % </th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data as $el)
					{{-- expr --}}
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td class="text-left">
							{{ $el['eleve']->fullName }}  
						</td>

						<td>
							{{ $el['eleve']->sexe }}
						</td>
						<td>
							{{ $cours->ponderation }}
						</td>
						<td>
							{{ $cours->ponderation_compentance }}
						</td>
						<td>
							{{ $cours->ponderation_examen }}
						</td>
						<td>
							{{ $max_total }}
						</td>

						@foreach ($el['points'] as $points_listes)
							{{-- expr --}}
							   @foreach ($points_listes as $p)
							   	{{-- expr --}}
							   	
							   	@if ($p != 0)
							   		{{-- expr --}}
							   		<td>{{ getPrice($p,'',1) }}</td>
							   	@else
							   	    <td></td>
							   	@endif
							   @endforeach
		
							
						@endforeach

						<td>{{ $max_total * 3 }}</td>
						<td>{{ getPrice($el['total_annuel'],'',1) }}</td>
						<td>
							{{ getPrice($el['total_annuel'] * 100 / 
							($max_total * 3))}}
						</td>

					</tr>
				@endforeach
				
			</tbody>
		</table>
	</div>
</div>