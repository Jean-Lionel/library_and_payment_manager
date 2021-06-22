<div>
    {{-- The best athlete wants his opponent at his best. --}} 

   <div> 

        <style type="text/css">
        
        table{
            border-collapse: collapse;
            width: 100%;
        }
        table, th,td,tr{
            border: 1px solid black;
        }

        .all_bullettin{

            height: 600px;
            overflow: auto;
        }
        </style>

        <div>
            <select wire:model="classe">
                <option value="">.. select</option>
                @foreach ($sections as $section)
                {{-- expr --}}
                <optgroup label="{{$section->name }}">
                   
                    @foreach ($section->classes as $classe)
                        {{-- expr --}}
                         <option value="{{ $classe->id }}">{{$classe->name }}</option>
                    @endforeach

                </optgroup>

                @endforeach
            </select>
            
        </div>

        <div class="all_bullettin">

        @if($selectClasse)
            <div><button onclick="printAllBilletin()"><i class="fa fa-print" ></i>Imprimer</button></div>
            @foreach($selectClasse->eleves as $eleve )
            <div class="bullettin_eleve" id="print_bullitin">
                 <table>
                <thead>
                    <tr>
                        <th colspan="20" style="text-align: left;">
                            Nom et Prénom : {{$eleve->fullName}}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="3" style="text-align:left;">
                            <span>Classe : {{ $selectClasse->name ?? "" }}</span> <br>
                            <span>
                            Nombre d'élèves : {{ $selectClasse ? $selectClasse->nombre_eleves() : 0}}
                        </span>
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
                            Résultats Annuels
                        </th>
                    </tr>
                    <tr>
                        <th>N°</th>
                        <th colspan="2">Domaines / Disciplines</th>
                        <th>T.J</th>
                        <th>Ex.</th>
                        <th>Total</th>

                        <th>TJ</th>
                        <th>EX</th>
                        <th>TOT</th>

                        <th>TJ</th>
                        <th>EX</th>
                        <th>TOT</th>

                        <th>TJ</th>
                        <th>EX</th>
                        <th>TOT</th>

                        <th>MAX</th>
                        <th>TOT</th>
                        <th>%</th>
                        <th>A.P</th>
                        
                    </tr>
                </thead>

                <tbody>
                @foreach( $courseCategories as $key => $courseCategorie)

                    @if($key)

                    @foreach ($courseCategorie as $k => $course)
                        {{-- expr --}}

                         @php
                                $interr_trimestre_1 = recuperer_point($eleve_id = $eleve->id ,$cour_id = $course->id, $trimestre_id = 1, $anne_scolaire_id = $anneScolaire , $type_evaluation = 'INTERROGATION' );
                                $interr_trimestre_2 = recuperer_point($eleve_id = $eleve->id ,$cour_id = $course->id, $trimestre_id = 2, $anne_scolaire_id = $anneScolaire , $type_evaluation = 'INTERROGATION' );
                                $interr_trimestre_3 = recuperer_point($eleve_id = $eleve->id ,$cour_id = $course->id, $trimestre_id = 3, $anne_scolaire_id = $anneScolaire , $type_evaluation = 'INTERROGATION' );

                                $examen_trimestre_1 = recuperer_point($eleve_id = $eleve->id ,$cour_id = $course->id, $trimestre_id = 1, $anne_scolaire_id = $anneScolaire , $type_evaluation = 'EXAMEN' );
                                $examen_trimestre_2 = recuperer_point($eleve_id = $eleve->id ,$cour_id = $course->id, $trimestre_id = 2, $anne_scolaire_id = $anneScolaire , $type_evaluation = 'EXAMEN' );
                                $examen_trimestre_3 = recuperer_point($eleve_id = $eleve->id ,$cour_id = $course->id, $trimestre_id = 3, $anne_scolaire_id = $anneScolaire , $type_evaluation = 'EXAMEN' );

                                $total_annuel = addTreeNumber(addTwoNumber($interr_trimestre_1, $examen_trimestre_1), addTwoNumber($interr_trimestre_2, $examen_trimestre_2),addTwoNumber($interr_trimestre_3 ,$examen_trimestre_3))

                                @endphp

                     @if($k == 0)
                        <tr style="">
                            <td rowspan="{{count($courseCategorie) }}">{{ count($courseCategorie) }}</td>
                            <td rowspan="{{count($courseCategorie) }}">
                                {{$key}}
                            </td>
                            <td colspan="">{{ $course->name }}</td>
                            <td colspan="">{{ $course->credit }}</td>
                            <td colspan="">{{ $course->ponderation }}</td>
                            <td colspan="">{{ $course->ponderation }}</td>
                            <td colspan="">{{ $course->ponderation * 2 }}</td>
                            <td>{{ $interr_trimestre_1 }}</td>
                            <td> {{$examen_trimestre_1 }}</td>
                            <td> 
                                {{ addTwoNumber($interr_trimestre_1, $examen_trimestre_1) }}  
                            </td>
                            <td>{{ $interr_trimestre_2 }}</td>
                            <td> {{$examen_trimestre_2 }}</td>
                            <td> 
                                {{ addTwoNumber($interr_trimestre_2, $examen_trimestre_2) }}  
                            </td>

                            <td>{{ $interr_trimestre_3 }}</td>
                            <td> {{$examen_trimestre_3 }}</td>
                            <td> 
                                {{ addTwoNumber($interr_trimestre_3 ,$examen_trimestre_3) }}  
                            </td>
                            <td>
                                {{ $course->ponderation * 6}}
                            </td>
                            <td>
                                {{$total_annuel }}
                            </td>
                            <td>
                                {{ getPourcentage($total_annuel, ($course->ponderation * 6)) }}
                            </td>
                            <td></td>
                            
                        </tr>
                     @else
                        <tr>
                            <td colspan="">{{ $course->name }}</td>
                            <td colspan="">{{ $course->credit }}</td>
                            <td colspan="">{{ $course->ponderation }}</td>
                            <td colspan="">{{ $course->ponderation }}</td>
                            <td colspan="">{{ $course->ponderation *2 }}</td>
                            <td>{{ $interr_trimestre_1 }}</td>
                            <td> {{$examen_trimestre_1 }}</td>
                            <td> 
                                {{ addTwoNumber($interr_trimestre_1, $examen_trimestre_1) }}  
                            </td>
                            <td>{{ $interr_trimestre_2 }}</td>
                            <td> {{$examen_trimestre_2 }}</td>
                            <td> 
                                {{ addTwoNumber($interr_trimestre_2, $examen_trimestre_2) }}  
                            </td>

                            <td>{{ $interr_trimestre_3 }}</td>
                            <td> {{$examen_trimestre_3 }}</td>
                            <td> 
                                {{ addTwoNumber($interr_trimestre_3 ,$examen_trimestre_3) }}  
                            </td>
                            <td> {{ $course->ponderation * 6}}</td>
                            <td>
                                
                                {{
                                  $total_annuel 
                                }}
                            </td>
                            <td>
                                {{ getPourcentage($total_annuel, ($course->ponderation * 6)) }}
                            </td>
                            <td></td>
                        </tr>
                  
                      @endif
                    

                    @endforeach

                    @endif
                     

                    @endforeach

                   
                  
            
                    <tr>
                        <td colspan="3" rowspan="2" style="height: 100px;">
                            Signature
                        </td>
                        <td colspan="4" >
                            Tutulaire
                        </td>
                        <td colspan="3" >
                            
                        </td>
                        <td colspan="3" >
                            
                        </td>
                        <td colspan="3" >
                            
                        </td>
                        <td colspan="4" >
                            
                        </td>
                    
                    </tr>

                    <tr>
                    
                        <td colspan="4" >Parent</td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                        <td colspan="3"></td>
                        <td colspan="4"></td>
                        
                    </tr>
                    
                </tfoot>
            </table>

            <div>
                <p style="text-align:center;">Signature du Recteur et Sceau de l'école</p>
            </div>
            </div>

         @endforeach
         @endif

        </div>
    </div>
</div>

@push('scripts')
<script>
    function printAllBilletin(){
       // const a = document.getElementById("print_bullitin")
        printJS({
            printable: 'print_bullitin',
            css : "",
            type : 'html',
        });
    }
</script>
@endpush


