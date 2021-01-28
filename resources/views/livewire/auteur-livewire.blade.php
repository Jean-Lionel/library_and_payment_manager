<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}

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
    	<div class="col-md-4">
    		<h4>Enregistrement de l'auteur</h4>
    		<form action="" wire:submit.prevent='saveAuthor'>
    			

    			<div class="form-group">
    				<label>Nom de l'auteur</label>
    				<input class="form-control" type="text" wire:model="name" name="">

                    @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
    			</div>


    			<div class="form-group">
    				<label>Pay d'orgine</label>
    				<input class="form-control" type="text" wire:model="pay_orgine" name="">
    			</div>

    			<div class="mt-4">
    				<button class="btn btn-primary">Enregistrer</button>
    			</div>
    		</form>
    	</div>

    	<div class="col-md-8">
    		<h3>Liste des auteurs</h3>

    		<table class="table">
    			<thead>
    				<tr>
    					<th>NO</th>
    					<th>NOM</th>
    					<th>PAY D'ORIGINE</th>
    					<th>Action</th>
    				</tr>

    			</thead>

    			<tbody>
    				@forelse($auteurs as $auteur)
    				<tr>
    					<td>{{ $auteur->id }}</td>
    					<td>{{ $auteur->name }}</td>
    					<td>{{ $auteur->pay_orgine }}</td>
    				</tr>

    				@empty
    				<p>Pas des auteurs</p>

    				@endforelse
    			</tbody>
    		</table>

            {{ $auteurs->links() }}
    		
    	</div>
    </div>
</div>
