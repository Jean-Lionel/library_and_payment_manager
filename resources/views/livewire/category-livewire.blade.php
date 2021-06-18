<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="row">
    	<div class="col-md-4">
    		<form wire:submit.prevent="saveCategory">
    			<div class="form-group">
    				<label for="">DESCRIPTION</label>
    				<input type="text" wire:model="name" class="form-control" >
    				@error('name')
    				<span class="error text-danger">{{ $message }}</span>
    				@enderror
    			</div>

    			<div class="form-group">
    				<label for="">STOCK</label>
    				
    				<select wire:model="stock_id" id="" class="form-control">
    					<option value="">Select ...</option>
    					@foreach($stoks as $stock)
    					<option value="{{ $stock->id }}">{{ $stock->name }}</option>

    					@endforeach
    				</select>

    				@error('stock_id')
    				<span class="error text-danger">{{ $message }}</span>
    				@enderror

    				<button class="btn btn-primary" type="submit">Enregistrer</button>
    			</div>
    		</form>
    	</div>

    	<div class="col-md-8">
    		<h4>Liste des categories</h4>
    		<table class="table table-bordered table-sm">
    			<thead>
    				<tr>
    					<th>#</th>
    					<th>STOCK</th>
    					<th>CATEGORIE</th>
    					<th>ACTION</th>
    				</tr>
    				
    			</thead>

    			<tbody>
    				@foreach($categories as $category)
    				<tr>
    					<td>{{ $category->id }}</td>
    					<td>{{ $category->stock->name }}</td>
    					<td>{{ $category->name }}</td>
    					<td>
    						<button wire:click="edit({{ $category->id  }})" class="btn btn-sm btn-warning">Modifier</button>
                            @if($category->products->count() == 0)
    						<button wire:click="destroy({{  $category->id  }})" class="btn btn-sm btn-danger">Supprimer</button>

                            @endif
    					</td>
    				</tr>

    				@endforeach
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
