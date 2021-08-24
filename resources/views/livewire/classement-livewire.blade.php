<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div class="row">
    	<div class="col-md-3">
    		<form action="" wire:submit.prevent="saveClassement()">
    			<div class="form-group">
    				<label for="">DESCRIPTION</label>
    				<input class="form-control" type="text" wire:model="name" name="">
    				 @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
    			</div>

    			<div class="form-group">
    				<label for="">Etagère</label>

                    {{$etagere_id}}
    				
    				<select class="form-control" wire:model="etagere_id">
                        <option value=""></option>
    					@foreach($etageres as $etager)

    					<option value="{{ $etager->id }}">{{ $etager->name }}</option>

    					@endforeach
    				</select>

    				 @error('etagere_id')
                           <span class="error text-danger">{{ $message }}</span>
                         @enderror
    			</div>

    			<div class="form-group">
    				<button class="btn btn-primary btn-block">Enregistrer</button>
    			</div>
    			
    		</form>
    	</div>

    	<div class="col-md-8">
    		<h3 class="text-center">Liste des classements</h3>
            <input type="text" wire:model="search" class="form-control">

    		<table class="table">
    			<thead>
    				<tr>
    					<th>No</th>
    					<th>DESIGNATION</th>
    					<th>ETAGERE</th>
    					<th>ACTION</th>
    				</tr>
    			</thead>

    			<thead>
    				@forelse($classements as $key => $classement)
    				<tr>
    					<td> {{ ++$key }}</td>
    					<td>{{ $classement->name }}</td>
    					<td>{{ $classement->etager->name }}</td>
    					<td>{{ $classement->description }}</td>
                        <td>
                            <button class="btn-info" wire:click="updateClassement({{ $classement->id}})">Modifier</button>
                        </td>
    				
    				</tr>

    				@empty
    				<tr>
    					<td colspan="5">
    						<h5 class="text-center">la liste des classements est vide</h5>
    					</td>
    				</tr>

    				@endforelse
    			</thead>
    		</table>
    	</div>
    </div>
</div>
