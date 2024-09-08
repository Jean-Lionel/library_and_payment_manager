<div>
    {{-- The Master doesn't talk, he acts. --}}

    <div class="col-md-12"> 	

    	<table id="table" width="100%" class="table table-hover">
    		<thead>
    			<tr>
    				<th colspan="3">Lecteur</th>
    				<th>Livre Retirer</th>
    				<th>date de retrait</th>
    				<th>Date de retour</th>
    			</tr>
                <tr>
                    <th>Nom et Prénom</th>
                    <th>Classe</th>
                    <th>Numéro</th>
                    <th>DATE DE </th>
                    <th>DATE</th>
                </tr>
            </thead>

            <tbody>
               @forelse($empruts as $emprut)
               <tr>
                <td> {{ $emprut->eleve->fullName }}</td>
                <td> {{ $emprut->eleve->classe->name }}</td>
                <td> {{ $emprut->eleve->id }}</td>

                <td>
                    <table>
                        <tr>
                            <th>Titre</th>
                            <th>Nombre</th>
                        </tr>
                        @foreach($emprut->detailsBooks as $value)
                        <tr>
                            <td class="d-flex justify-content-between">
                                {{ $value->book->title }}
                            </td>
                            <td> {{ $value->quantite }} </td>
                        </tr>
                        @endforeach 
                            
                        </table>

                </td>
                    <td>{{ $emprut->date_retrait }}</td>
                    <td>{{ $emprut->date_retour }}</td>

                </tr>

                @empty

                @endforelse
            </tbody>
        </table>
    </div>


</div>

@push('scripts')
<script>

    $(document).ready( function () {
        $('#table').dataTable({
            dom: 'Bfrtip',
            buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
            ], 
            pagingType: "full_numbers",
            scrollX: true,
        });
        
    } );

</script>
@endpush