
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
			<p><b>CLASSE : </b></p>
			<p><b>BRANCHE : </b></p>
			<p><b>ANNEE SCOLAIRE : </b></p>
		</div>
		<div class="header-right">
			<p>Le {{ date('d-m-Y') }}</p>
		</div>
	</div>

	<div style="clear: both;"></div>
	
	<div>
		<h5 class="text-center"><u>PALMARES DES RESULTATS</u></h5>

		<table>
			<thead>
				<tr>
					<th rowspan="2">Place</th>
					<th rowspan="2">Nom et prénom</th>
					<th rowspan="2">Sexe</th>
					<th rowspan="2">Totat des points obtenus</th>
					<th rowspan="2">%</th>
					<th colspan="{{ $courses->count()  }}">Echecs</th>
					<th rowspan="2">Décision du jury</th>
				</tr>
				<tr>
					@foreach ($courses as $course)
					{{-- expr --}}
					<th>{{ $course->name }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($palmares as $eleve)
				{{-- expr --}}
				<tr>
					<td> {{ ++$loop->index }}</td>
					<td class="text-left">{{ $eleve->fullName }}</td>
					<td class="text-center">{{ $eleve->sexe }}</td>
					<td>{{ $eleve->points }}</td>
					<td>{{ $eleve->pourcentage }}</td>
					@foreach ($eleve->courses_listes as $course)
					{{-- expr --}}
					<td>{{ $course['profondeur_echec'] < 0 ? $course['profondeur_echec'] : '' }}</td>
					@endforeach
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
</div>