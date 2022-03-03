<div>
    {{-- The whole world belongs to you --}}
     @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
    @endif

     @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
    @endif

    <div class="row">

        @if($showForm)
    	 <div class="col-md-4 offset-md-3">
    		<h4>Ajouter un livre</h4>
    		<form action="" wire:submit.prevent="saveBook()">
    			<div class="form-group">
    				<label for=""> TITLE </label>
    				<input class="form-control form-control-sm" type="text" wire:model="title" name="">
    				@error('title')
    						<span class="error text-danger">{{ $message }}</span>
    						@enderror
    			</div>

    			<div class="form-group">
    				<label for="">CLASSEMENT</label>
    				<select wire:model="classement_id" class="form-control form-control-sm">
    					<option value="">Choisissez ...</option>

    					@forelse($classements as $classement)
    					<option value="{{ $classement->id }}">{{ $classement->name }}</option>
    					@empty
    					 <option value="">PAS DE CLASSEMENT DISPONIBLE VEUILLEZ CREER UNE</option>

    					@endforelse
    				</select>
    				@error('classement_id')
    						<span class="error text-danger">{{ $message }}</span>
    						@enderror
    			</div>

    			<div class="form-group">
    				<label for="">AUTEUR</label>
    				<select wire:model="auteur_id" class="form-control form-control-sm">
    					<option value="">Choisissez ...</option>

    					@forelse($authors as $author)
    					<option value="{{ $author->id }}">{{ $author->name }}</option>
    					@empty
    					
    					@endforelse
    				</select>

    				@error('auteur_id')
    						<span class="error text-danger">{{ $message }}</span>
    						@enderror
    				
    			</div>

    			<div class="form-group">
    				<label for="">EDITION</label>
    				<input type="" wire:model="edition" class="form-control form-control-sm" name="">
    			</div>
    			<div class="form-group">
    				    <label for=""> NOMBRE D'EXEMPLAIRE </label>
    				<input class="form-control form-control-sm" type="number" wire:model="nombre_exemplaire" name="">

    				@error('nombre_exemplaire')
    						<span class="error text-danger">{{ $message }}</span>
    						@enderror
    			
    			</div>

    			<div class="form-group">
    				<button class="btn btn-info btn-block">Enregistrer</button>
    			</div>


    		</form>
    	</div> 

        @else

    	<div class="col-md-12">
            <h4 class="text-center">Liste des livres</h4>
            <div class="text-right">
                <input type="text" placeholder="Rechercher ici !!">
                <button wire:click="$set('showForm',true)">Ajouter</button></div>
    		<table class="table table-hover table-sm table-striped ">
    			<thead>
    				<tr>
    					<th>No</th>
    					<th>TITLE</th>
    					<th>AUTEUR</th>
    					<th>CLASSEMENT</th>
    					<th>ETAGERE</th>
                        <th>EDITION</th>
                        <th>Qté</th>
                        <th>Livre retire</th>
                        <th>Livre restant</th>
    					<th>ACTION</th>
    				</tr>
    			</thead>

    			<tbody>
    				@forelse($books as $book)
    					<tr>
    						<td>{{ $book->id }}</td>
    						<td>{{ $book->title }}</td>
    						<td>{{ $book->author->name }}</td>
    						<td>{{ $book->classement->name }}</td>
    						<td>{{ $book->classement->etager->name }}</td>
    						<td>{{ $book->edition }}</td>
                            <td>{{ $book->nombre_exemplaire }}</td>
                            <td>{{ $book->nombre_livre_retire ?? 0 }}</td>
                            <td>{{($book->nombre_exemplaire - $book->nombre_livre_retire) ?? 0 }}</td>

                            <td class="d-flex">
                                <button class="btn-sm btn-warning" wire:click="updateBook({{ $book->id }})" title="Modifier"> <i class="fa fa-edit"></i> </button>

                                <button wire:click="$emit('triggerDelete', {{$book->id}})" class="ml-3 btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
    					</tr>
    				@empty
    				<td colspan="8">
    					<h5>Pas des des livres disponibles</h5>
    				</td>

    				@endforelse
    			</tbody>
    		</table>

            {{ $books->links()}}
    	</div>

        @endif

    </div>

</div>


@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function(){

        @this.on('triggerDelete', bookId =>{
             Swal.fire({
                title: 'Are You Sure?',
                text: 'Order record will be deleted!',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'var(--success)',
                cancelButtonColor: 'var(--primary)',
                confirmButtonText: 'Delete!'
            }).then((result) => {
        //if user clicks on delete
                if (result.value) {
             // calling destroy method to delete
                    @this.call('supprimerLivre',bookId)
            // success response
                    responseAlert({title: session('message'), type: 'success'});
                    
                } else {
                    responseAlert({
                        title: 'Operation Cancelled!',
                        type: 'success'
                    });
                }
            });

        });

    });
    
</script>

@endpush
