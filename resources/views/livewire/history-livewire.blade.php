<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="row">
    	
    	<table class="table table-bordered">
    		<thead>
    			<tr>
    				<th>Lecteur</th>
    				<th>Livre Retirer</th>
                    <th>Nombre d'ex</th>
    				<th>date de retrait</th>
    				<th>Date de retour</th>
    			</tr>
    		</thead>

    		<tbody>
    			@forelse($empruts as $emprut)
    			<tr>
    				<td>23</td>
    				<td>
    					<ul>
                            @foreach($emprut->detailsBooks as $value)
                            <li class="d-flex justify-content-between">

                                <span>{{ $value->book->title }}</span>
                                <span>Nombre d'exemplaire : 
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
