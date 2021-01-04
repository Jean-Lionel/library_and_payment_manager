<div>
    {{-- Because she competes with no one, no one can compete with her. 

    	c $name;
	public $identifiant;
	public $marque;
	public $quantite;
	public $price;
	public $category_id;
	public $categories;


    	--}}

    <form wire:submit.prevent="saveProduct">
    	<div class="row">
    		<div class="col-md-6">
    			
    			<div class="form-group row">
    				<label for="" class="col-sm-4">
    					DESIGNATION
    				</label>
    			
    				<div class="col-md-8">
    						<input type="text" wire:model="name" class="form-control">

    						@error('name')
    						<span class="error text-danger">{{ $message }}</span>
    						@enderror
    					
    				</div>
    			</div>

    		</div>
    		<div class="col-md-6">
    			

    		</div>
    	</div>
    </form>
</div>
