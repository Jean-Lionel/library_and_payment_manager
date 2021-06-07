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
            @foreach($selectClasse->eleves as $eleve )
            <div class="bullettin_eleve">
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
                            <td colspan="13"></td>
                        </tr>
                     @else
                        <tr>
                            <td colspan="">{{ $course->name }}</td>
                            <td colspan="">{{ $course->credit }}</td>
                            <td colspan="">{{ $course->ponderation }}</td>
                            <td colspan="">{{ $course->ponderation }}</td>
                            <td colspan="">{{ $course->ponderation *2 }}</td>
                            <td colspan="13"></td>
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