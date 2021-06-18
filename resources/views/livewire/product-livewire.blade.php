<div>
    {{-- Because she competes with no one, no one can compete with her. 


    	--}} 
    @if($showForm)

    <form wire:submit.prevent="saveProduct">

    	<div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
             </div>

             <h5 class="text-center col-md-12">Ajouter un nouveau produit</h5>
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

                <div class="form-group row">
                    <label for="" class="col-sm-4">
                        MARQUE
                    </label>
                    <div class="col-md-8">
                            <input type="text" wire:model="marque" class="form-control">

                            @error('marque')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        
                    </div>
                </div>

                 <div class="form-group row">
                    <label for="" class="col-sm-4">
                        CATEGORIE
                    </label>
                    <div class="col-md-8">
                            <select wire:model="category_id" id="" class="form-control"> 
                                <option value="">Select ....</option>

                                @foreach($categories as $category)

                                <option value="{{ $category->id }}">{{ $category->name  }}</option>



                                @endforeach
                            </select>

                            @error('category_id')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        
                    </div>
                </div>


                

    		</div>
    		<div class="col-md-6">


                 <div class="form-group row">
                    <label for="" class="col-sm-4">
                        QUANTITE
                    </label>
                    <div class="col-md-8">
                            <input type="text" wire:model="quantite" class="form-control">

                            @error('quantite')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        
                    </div>
                </div>


                  <div class="form-group row">
                    <label for="" class="col-sm-4">
                        PRICE UNITAIRE
                    </label>
                    <div class="col-md-8">
                            <input type="text" wire:model="price" class="form-control">

                            @error('price')
                            <span class="error text-danger">{{ $message }}</span>
                            @enderror
                        
                    </div>
                </div>


                   <div class="form-group row">
                    <label for="" class="col-sm-4">
                       
                    </label>
                    <div class="col-md-8">
                            <button class="btn btn-primary btn-block">Enregistrer</button>
                        
                    </div>
                </div>	

    		</div>
    	</div>
    </form>

    @endif


    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Liste des Produits</h4>
            <div class="d-flex justify-content-between">
                <input type="text" wire:model="searchTerm" placeholder="Rechercher ici !..." />

                <button class="btn btn-sm btn-info" wire:click="toogleShowForm" style="font-size:15px"> <i class="material-icons">add</i></button>

            </div>
            
            <table class="table-sm table">

                <thead class="badge-dark">
                    <tr>
                        <td>#</td>
                        <td>DATE</td>
                        <td>DESIGNATION</td>
                        <td>MARQUE</td>
                        <td>CATEGORIE</td>
                        <td>QUANTITE</td>
                        <td>PRICE UNITAIRE</td>
                        <td>Action</td>
                    </tr>
                    
                </thead>

                <tbody>

                    @foreach($products as $product)

                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->marque }}</td>
                        <td>{{ $product->category->name ?? "" }}</td>

                        <td  @if( $product->quantite < 10) class="bg-danger" @endif>{{ $product->quantite }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" wire:click="edit({{  $product->id }})"><i class='fa fa-edit'></i>Modifier</button>
                            <button class="btn btn-danger btn-sm" wire:click="destroy({{  $product->id }})"><i class='fa fa-remove'></i>Supprimer</button>
                        </td>
                    </tr>


                    @endforeach
                    
                </tbody>
                
            </table>

            {{ $products->links() }}
        </div>
    </div>
</div>
