
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
	.pied_page{
		margin-top: 40px;
	}

	@media print {
    .pagebreak { 
    	page-break-before: always; 
    } /* page-break-after works, as well */
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
				@php
					$taille = count(array_values($coursListe)[0]);
				@endphp
				<tr>
					<td rowspan="{{ $taille +1 }}" > {{ ++$loop->index }}  </td>
					@if(!is_numeric(array_keys($coursListe)[0]))
					<td class="text-left" rowspan="{{ $taille +1 }}" >
						<b>{{ array_keys($coursListe)[0] }}</b>
					</td>
					@else
					
					@endif
				</tr>

				@foreach ($coursListe as $cours)
				@foreach ($cours as $course)
				<tr>

					@if(!is_numeric(array_keys($coursListe)[0]))
					<td class="text-left">
						{{ $course['name'] }}
					</td>
					@else
					<td class="text-left" colspan="2">
						{{ $course['name'] }}
					</td>
					@endif
					
					<td>
						{{ $course['cours']->credit != 0 ?  $course['cours']->credit : '' }}
					</td>
					<td>{{ $course['cours']->ponderation }}</td>
					<td>{{ $course['cours']->totalExamen != 0 ? $course['cours']->totalExamen : '-' }}</td>

					<td>
						{{ $course['poderation'] }}
					</td>
					{{-- PREMIER TRIMESTRE --}}
					<td>{{ afficherPoint($course['interrogation']) }}</td>
					<td>{{ afficherPoint($course['examen']) }}</td>
					<td>{{ afficherPoint($course['total']) }}</td>

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
					<td></td>
					<th class="text-left" colspan="2">TOTAL</th>
					<td>{{ $data['ponderation_total']['total_credit']}}</td>
					<td>{{ $data['ponderation_total']['total_interrogation']}}</td>
					<td>{{ $data['ponderation_total']['total_examen']}}</td>
					<td>{{ $data['ponderation_total']['total']}}</td>
					
				<!-- 	I TRIMESTRE -->
					<td>{{ afficherPoint($eleve->points_total['INTERROGATION']) }}</td>
					<td>{{afficherPoint($eleve->points_total['EXAMEN']) }}</td>
					<td>{{afficherPoint($eleve->points_total['TOTAL']) }}</td>
				<!-- 	II TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<th class="text-left" colspan="2">Pourcentage</th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<!-- 	I TRIMESTRE -->s
					<td>
						<b>{{ afficherPoint($eleve->points_total['POURCENTAGE_INTERROGATION']) }}</b>
					</td>
					<td>
						<b>
						{{afficherPoint($eleve->points_total['POURCENTAGE_EXAMEN']) }}
						</b>
					</td>
					<td><b>{{ $eleve->pourcentage }}</b></td>
				<!-- 	II TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<th class="text-left" colspan="2">Place</th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<!-- 	I TRIMESTRE -->
					<td></td>
					<td></td>
					<td>
						<b>
						{!! affichePlace(++$loop->index, $eleve->is_a_girl()) !!}
						</b>
					</td>
				<!-- 	II TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<th class="text-left" colspan="2">Education Morale</th>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				<!-- 	I TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	II TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
				<!-- 	III TRIMESTRE -->
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<th colspan="3" rowspan="2" >Signatures</th>
					<td colspan="4" class="text-left">Tutulaire</td>
					<td colspan="3"></td>
					<td colspan="3"></td>
					<td colspan="3"></td>
					<td colspan="4"></td>
				</tr>
				<tr>
					<td colspan="4" class="text-left">Parent</td>
					<td colspan="3"></td>
					<td colspan="3"></td>
					<td colspan="3"></td>
					<td colspan="4"></td>
				</tr>
			</tbody>
		</table>

		<div class="pagebreak pied_page">
			
		</div>
	</div>

	@endforeach
