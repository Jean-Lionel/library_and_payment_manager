<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="row"> 	
        <div>
            <input type="text" >
        </div>
    	<table class="table table-sm table-bordered">
    		<thead>
    			<tr>
    				<th>Lecteur</th>
    				<th>Livre Retirer</th>
    				<th>date de retrait</th>
    				<th>Date de retour</th>
    			</tr>
    		</thead>

    		<tbody>
    			@forelse($empruts as $emprut)
    			<tr>
    				<td>
                        {{ $emprut->eleve->fullName }} <br>
                        Classe : {{ $emprut->eleve->classe->name }}
                        <br>
                        N° : {{ $emprut->eleve->id }}
                    </td>
    				<td>
    					<ul>
                            @foreach($emprut->detailsBooks as $value)
                            <li class="d-flex justify-content-between">

                                <span>{{ $value->book->title }}</span>
                                <span>Nombre : 
                                    {{ $value->quantite }}</span>
                            </li>
                            <hr>
                            @endforeach 
                        </ul>
    				</td>
    				<td>{{ $emprut->date_retrait }}</td>
    				<td>{{ $emprut->date_retour }}</td>
    				
    			</tr>

    			@empty

    			@endforelse
    		</tbody>
    	</table>
    </div>

    {{ $empruts->links() }}
</div>
