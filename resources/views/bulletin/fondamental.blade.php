<style>
	table{
		border-collapse: collapse;
		width: 100%;
	}
	tr,td,th,table,tbody,thead{
		border: 1px solid black;
	}
	.is_echec{
		color: red;
		text-decoration: underline;
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
	.pagebreak{
   		 page-break-before: always; 
	}

	@media print {
		.pagebreak { 
			page-break-before: always; 
		} 

		
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
					Classe : {{ $data['classe']->name }} <br>
					Nombres des élèves : {{$data['classe']->nombre_eleves() }} 
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

				$categories_name = array_keys($coursListe)[0];
				@endphp
				<tr>
					<td rowspan="{{ $taille +2 }}" > {{ ++$loop->index }}  </td>
					@if(!is_numeric($categories_name))
					<td class="text-left" rowspan="{{ $taille +2 }}" >
						<b>{{ $categories_name }}</b>
					</td>
					@else
					
					@endif
				</tr>

				@foreach ($coursListe as $cours)
				@foreach ($cours as $course)
				<tr>
					@php
					$course_name = $course['name'];
					@endphp

					@if(!is_numeric($categories_name))
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
				{{-- 	<td>{{ afficherPoint($course['interrogation']) }}</td>
					<td>{{ afficherPoint($course['examen']) }}</td>
					<td>{{ afficherPoint($course['total']) }}</td> --}}
					@php
					$cours_total_annuel = 0;
					@endphp
					@foreach ($eleve->trimestre as $trimestre)
					@php
					$cours_categories_points = array_values($trimestre['courses_listes'][$key])[0];
					$getCourse = [];
					foreach ($cours_categories_points as $e){
						if($e['name'] ==  $course_name){
							$getCourse = $e;
							break;
						}
					}
					$cours_total_annuel  += floatval($getCourse['total']);
					@endphp
					<td>
						{{	afficherPoint($getCourse['interrogation'])}}
					</td>
					<td>{{	afficherPoint($getCourse['examen'])}} </td>
					<td 
					@if ($getCourse['is_echec'])
					{{-- expr --}}
					class="is_echec"
					@endif
					
					>{{	afficherPoint($getCourse['total'])}}</td>
					@endforeach
					{{--  --}}
					<td class="bold">
						{{ $course['cours']->ponderationTotal * 3 }}
					</td>
					@if (!$eleve->afficher_total_annuel)
					{{-- expr --}}
					<td>
						{{ afficherPoint($cours_total_annuel) }}
					</td>
					<td>
						{{
							afficherPoint(getPourcentage($cours_total_annuel, ($course['cours']->ponderationTotal * 3)))
						}}
					</td>
					@else

					<td></td>
					<td></td>

					@endif
					
					<td></td>
				</tr>
				@endforeach
				<tr>
					
					@if(!is_numeric(array_keys($coursListe)[0]))
					<th class="text-left">TOTAL</th>
					@php
					$categoriesTotal = array_values($coursListe)[0];

					$maxima_annuel = sumColumn($categoriesTotal, 'max_tj_examen') * 3;
					@endphp
					{{-- MAXIMA --}}

					<th>{{ sumColumn($categoriesTotal, 'credit') }}</th>
					<th>{{ sumColumn($categoriesTotal, 'ponderationTJ') }}</th>
					<th>{{ sumColumn($categoriesTotal, 'ponderationEx') }}</th>
					<th>{{ sumColumn($categoriesTotal, 'max_tj_examen') }}</th>
					{{-- I TRIMESTRE --}}

					@php
					$categorie_name = array_keys($coursListe)[0];
					$total_annuel_categorie = 0;
					@endphp
					@foreach ($eleve->trimestre as $element)
					{{-- expr --}}	
					@php
					$total_annuel_categorie += $element['categoriesTotal'][$categorie_name][0]['total'];
					@endphp
					
					<th> 
						{{ 
							afficherPoint($element['categoriesTotal'][$categorie_name][0]['tj'])
						}}
					</th>
					<th> 
						{{
							afficherPoint(
								$element['categoriesTotal'][$categorie_name][0]['examen'] )
							}}
						</th>
						<th> 
							{{ afficherPoint($element['categoriesTotal'][$categorie_name][0]['total']) }}
						</th> 
						@endforeach
						<th>{{ afficherPoint($maxima_annuel) }}</th>

						@if (!$eleve->afficher_total_annuel)
						{{-- expr --}}
						
						<th>{{afficherPoint($total_annuel_categorie)}}</th>
						<th
						@if (getPourcentage($total_annuel_categorie,$maxima_annuel) < 50 )
						{{-- expr --}}
						class="is_echec"
						@endif

						>
					{{ getPourcentage($total_annuel_categorie,$maxima_annuel) }}</th>
					@else
					<th></th>
					<th></th>

					@endif
					<th></th>

					@endif

					
				</tr>
				@endforeach
				@endforeach

				<tr>
					<td></td>
					<th class="text-left" colspan="2">TOTAL</th>
					<th>{{ $data['ponderation_total']['total_credit']}}</th>
					<th>{{ $data['ponderation_total']['total_interrogation']}}</th>
					<th>{{ $data['ponderation_total']['total_examen']}}</th>
					<th>{{ $data['ponderation_total']['total']}}</th>
					
					<!-- 	I TRIMESTRE -->
					@php
					$max_total_an = 0;
					@endphp

					@foreach ($eleve->trimestre as $el)
					{{-- expr --}}
					@php
					$max_total_an  += $el['total'];
					@endphp
					@if (!$el['isNonClasse'])
					<th> {{afficherPoint($el['points_total']['INTERROGATION'])}}</th>
					<th> {{afficherPoint($el['points_total']['EXAMEN'])}}</th>
					<th>{{ afficherPoint($el['total'])}}</th>
					@else
					<th></th>
					<th></th>
					<th></th>
					

					@endif
					
					@endforeach
					{{-- empty expr --}}

					@php
					$z = $data['ponderation_total']['total'] * 3;
					@endphp

					<th>{{$z  }}</th>

					@if (!$eleve->afficher_total_annuel)
					<th>{{ afficherPoint($max_total_an ) }}</th>
					<th 

					@if (getPourcentage( $max_total_an, $z ) < 50)
					{{-- expr --}}
					class="is_echec"
					@endif
					>
					{{ getPourcentage( $max_total_an, $z ) }}
				</th>

				@else
				<th></th>
				<th></th>
				@endif
				<th></th>
				
				
				<!-- 	III TRIMESTRE -->
				
			</tr>
			<tr>
				<td></td>
				<th class="text-left" colspan="2">Pourcentage</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<!-- 	I TRIMESTRE -->
				@foreach ($eleve->trimestre as $el)
				{{-- expr --}}
				@if (!$el['isNonClasse'])
				<th> {{afficherPoint($el['points_total']['POURCENTAGE_INTERROGATION'])}}</th>
				<th> {{afficherPoint($el['points_total']['POURCENTAGE_EXAMEN'])}}</th>
				<th>{{ afficherPoint($el['pourcentage'])}}</th>
				@else
				<th></th>
				<th></th>
				<th></th>
				@endif
				@endforeach

				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td></td>
				<th class="text-left" colspan="2">Place</th>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<!-- 	I TRIMESTRE -->

				@foreach ($eleve->trimestre as $element)
				{{-- expr --}}
				@if (!$element['isNonClasse'])
				<td>{!! affichePlace($element['place']['tj'], $eleve->is_a_girl()) !!}</td>
				<td>{!! affichePlace($element['place']['ex'], $eleve->is_a_girl()) !!}</td>
				<th>{!! affichePlace($element['place']['total'], $eleve->is_a_girl()) !!}</th>
				@else
				<th></th>
				<th></th>
				<th></th>
				@endif
				@endforeach
				<th></th>
				<th></th>
				<th></th>
				<th></th>
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

	<div>
		
	</div>

	<div class="pagebreak pied_page">
		
	</div>
</div>

@endforeach
