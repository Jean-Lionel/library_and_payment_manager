
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
					
					<th colspan=" {{ $nombres_cours + 
						count($courses) }} ">Echecs</th>
					<th rowspan="2">Décision du jury</th>
				</tr>
				<tr>
					@foreach ($courses as $key => 
						$courseCategorie)
					{{-- expr --}}
					@foreach ($courseCategorie as $element)
						<th>{{ $element->name }}</th>
					@endforeach
					
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($palmares as $eleve)
				{{-- expr --}}
				<tr>
					@if ($loop->first)
						{{-- expr --}}
						@if ($eleve->is_a_girl())
							{{-- expr --}}
							<td> {{ ++$loop->index }} <sup>ère</sup></td>
						@else
						    <td> {{ ++$loop->index }} <sup>er</sup></td>
						@endif
						
					@else
						<td> {{ ++$loop->index }} <sup>ème</sup></td>
					@endif
					
					<td class="text-left">{{ $eleve->fullName }}</td>
					<td class="text-center">{{ $eleve->sexe }}</td>
					<td>{{ afficherPoint($eleve->points) }}</td>
					<td>{{ afficherPoint($eleve->pourcentage) }}</td>
					@foreach ($eleve->courses_listes as $coursesCategories)
					{{-- expr --}}
					@foreach ($coursesCategories as $courses)
						@foreach ($courses as $course)
							
							<td>{{ afficherPoint($course['profondeur_echec']) }}</td>
						@endforeach
					@endforeach
					
					@endforeach
					
				</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
</div>