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
{{-- 
    title
isbn
nombre_exemplaire
edition
auteur_id
classement_id --}}
    <div class="row">
    	<div class="col-md-4">
    		<h4>Ajouter un livre</h4>
    		<form action="" wire:submit.prevent="saveBook()">
    			<div class="form-group">
    				<label for=""> TITLE </label>
    				<input class="form-control" type="text" wire:model="title" name="">
    				@error('title')
    						<span class="error text-danger">{{ $message }}</span>
    						@enderror
    			</div>

    			<div class="form-group">
    				<label for="">CLASSEMENT</label>
    				<select wire:model="classement_id" class="form-control">
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
    				<select wire:model="auteur_id" class="form-control">
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
    				<input type="" wire:model="edition" class="form-control" name="">
    			</div>
    			<div class="form-group">
    				    <label for=""> NOMBRE D'EXEMPLAIRE </label>
    				<input class="form-control" type="text" wire:model="nombre_exemplaire" name="">

    				@error('nombre_exemplaire')
    						<span class="error text-danger">{{ $message }}</span>
    						@enderror
    			
    			</div>

    			<div class="form-group">
    				<button class="btn btn-info btn-block">Enregistrer</button>
    			</div>


    		</form>
    	</div>

    	<div class="col-md-8">
            <h4 class="text-center">Liste des livres</h4>
    		<table class="table">
    			<thead>
    				<tr>
    					<td>No</td>
    					<td>TITLE</td>
    					<td>AUTEUR</td>
    					<td>CLASSEMENT</td>
    					<td>ETAGERE</td>
                        <td>EDITION</td>
                        <td>Qte</td>
                        <td>Livre retire</td>
                        <td>Livre restant</td>
    					<td>ACTION</td>
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
                                <button class="btn btn-warning" wire:click="updateBook({{ $book->id }})" title="Modifier"> <i class="fa fa-edit"></i> </button>

                                <button wire:click="supprimerLivre({{ $book->id }})" class="ml-3"> <i class="fa fa-trash"></i> </button>
                            </td>
    					</tr>
    				@empty
    				<td colspan="8">
    					<h5>Pas des des livres disponibles</h5>
    				</td>

    				@endforelse
    			</tbody>
    		</table>
    	</div>

    </div>

</div>
