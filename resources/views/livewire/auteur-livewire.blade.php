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

    <style>
        .btn
        {
            background: #1A5684;
            color: #ffffff;
        }
    </style>


    <div class="row">
    	<div class="col-md-4">
    		<h4>Nouveau Auteur</h4>
    		<form action="" wire:submit.prevent='saveAuthor'>
    			<div class="form-group">
    				<label>Nom de l'auteur</label>
    				<input class="form-control rounded-0" type="text" wire:model="name" name="">

                    @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
    			</div>


    			<div class="form-group">
    				<label>Pays d'orgine</label>
    				<input class="form-control rounded-0" type="text" wire:model="pay_orgine" name="">
    			</div>

    			<div class="mt-4">
    				<button class="btn btn-sm w-100">Enregistrer</button>
    			</div>
    		</form>
    	</div>

    	<div class="col-md-8">
            <div class="row">
                <div class="col">
                    <h3>Liste des auteurs</h3>
                </div>
                <div class="col">
                     <input type="text" class="form-control rounded-0" wire:model="search">
                </div>
            </div>


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
                        <td>
                            <button class="btn btn-sm w-100" wire:click="updateAuteur({{$auteur->id}})">Modifier</button>
                        </td>
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
