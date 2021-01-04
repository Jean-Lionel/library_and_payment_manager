<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <div class="row">
    	<div class="col-md-4">
    		 <form wire:submit.prevent="saveStock">
    		 	<div class="form-group">
    		 		<label for="">DESIGNATION</label>
    		 		<input required="" type="text" wire:model="name">
    		 		<p>
    		 			@error('name')
    		 			<span class="error text-danger">{{ $message }}</span>
    		 			@enderror
    		 		</p>
    		 		<button type="submit" class="btn-primary btn-block btn-sm">Enregistrer</button>
    		 	</div>
    	
   			 </form>
    		
    	</div>
    	<div class="col-md-8">
    		<a class="btn btn-info" href="{{ route('categories.index') }}">Category</a>
            <a class="btn btn-info" href="{{ route('products.index') }}">Produits</a>
    		<table class="table table-sm"> 
    			<thead class="badge-dark">
    				<tr>
    					<th>#</th>
    					<th>DESIGNATION</th>
    					<th>ACTION</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach($stocks as $stock)
    				<tr>
    					<td>{{ $stock->id }}</td>
    					<td>{{ $stock->name }}</td>
    					<td>
    						<button class="btn btn-sm btn-warning" wire:click="edit({{ $stock->id }})">modifier</button>
    						<button class="btn btn-sm btn-danger" wire:click="destroy({{ $stock->id }})">Supprimer</button>
    					</td>
    				</tr>

    				@endforeach
    			</tbody>
    			
    		</table>
    	</div>
    </div>

   
</div>
