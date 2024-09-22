<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <style>
        .but
        {
            background: #1A5684;
            color: #ffffff;
        }
        .but:hover
        {
            color: #ffffff
        }
    </style>
    <div class="row">
    	<div class="col-md-4">
    		 <form wire:submit.prevent="saveStock">
                <h4 class="text-center">Ajout du Stock</h4>
    		 	<div class="form-group">
    		 		<label for="">NOM DU STOCK</label>
    		 		<input required="" class="form-control rounded-0" type="text" wire:model="name">
    		 		<p>
    		 			@error('name')
    		 			<span class="error text-danger">{{ $message }}</span>
    		 			@enderror
    		 		</p>
    		 		<button type="submit" class="btn but btn-sm w-100">Enregistrer</button>
    		 	</div>
   			 </form>
    	</div>
    	<div class="col-md-8">
    		<a class="btn btn-sm but" href="{{ route('categories.index') }}">Category</a>
            <a class="btn btn-sm but" href="{{ route('products.index') }}">Produits</a>
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
                            @if($stock->categories->count() ==0)
    						<button class="btn btn-sm btn-danger" wire:click="destroy({{ $stock->id }})">Supprimer</button>
                            @endif
    					</td>
    				</tr>

    				@endforeach
    			</tbody>

    		</table>
    	</div>
    </div>
</div>

@push('scripts')

<script>

</script>

@endpush
