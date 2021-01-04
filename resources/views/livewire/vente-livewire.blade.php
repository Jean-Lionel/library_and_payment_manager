<div>
    {{-- Do your work, then step back. --}}


    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Liste des Produits</h4>
            <div class="d-flex justify-content-between">
                <input type="text" wire:model="searchItem" placeholder="Rechercher ici !..." />

                <div>
                    {{--  <i class="fa fa-shopping-cart text-lg-center"></i> <span class="badge badge-light"></span> --}}

                    <button class="btn btn-sm btn-info" style="font-size:20px"> <i class="fa fa-shopping-cart"></i> {{ Cart::count()}}</button>
                </div>

            </div>
            
            <table class="table-sm table">

                <thead class="badge-dark">
                    <tr>
                        <td>#</td>
                        <td>DESIGNATION</td>
                        <td>MARQUE</td>
                        <td>CATEGORIE</td>
                        <td>QUANTITE EN STOCK</td>
                        <td>PRICE UNITAIRE</td>
                       {{--  <td>Qté</td>
                        <td>PRIX TOTAL</td> --}}
                        <td>Action</td>
                    </tr>
                    
                </thead>

                <tbody>

                    @foreach($products as $product)

                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->marque }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->quantite }}</td>
                        <td>{{ $product->price }}</td>

                        <td>

                            @if(!searchProduct( $product->id))
                            <button wire:click="addToCart({{$product->id  }})" class="btn btn-sm btn-info" style="font-size:15px"> <i class="material-icons">add</i></button>
                            @else
                                <i class="fa fa-check"></i>

                            @endif
                            
                        </td>
                    </tr>


                    @endforeach
                    
                </tbody>
                
            </table>

            {{ $products->links() }}
        </div>

        <div class="row col-md-12">

            <div class="col-md-8">
                <h4>PANIER</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th class="text-center">Prix</th>
                                <th class="text-center">Total</th>
                                <th> Enleve</th>
                            </tr>
                        </thead>

                        <tbody>

                             @foreach(Cart::content() as $cartItem)
                             <tr>
                                <td>
                                    <div class="media">
                                        <div class="media-body">
                                        <h5 class="mt-0 mb-1">{{ $cartItem->model->name }}</h5>
                                        
                                         </div>
                                    </div>
                                </td>

                                <td>

                                    <input type="number" class="form-control {{ $inputFormControl }}" wire:keydown.enter="updateQuantite($event.target.value, '{{ $cartItem->rowId }}')" value="{{ $cartItem->qty }}">
                                 {{--    <input type="text"  wire:keydown="updateQuantite($event.target.value,{{  $cartItem->rowId }})" value="{{ $cartItem->qty }}"> --}}
                                </td>

                                <td>
                                    {{ $cartItem->model->price }}
                                </td>
                                <td>
                                    {{ $cartItem->subtotal() }}
                                </td>
                                <td>
                                    <button wire:click="removeItem('{{ $cartItem->rowId }}')">Remove</button>
                                </td>
                            
                            </tr>
                   

                             @endforeach
                            
                        </tbody>
                    </table>
                   
                    
               
               
                
            </div>

            <div class="col-md-4">
                <h5>DESCRIPTION</h5>
                <div class="d-flex justify-content-between">
                    <span>PHTVA </span>
                    <span>{{ Cart::subtotal() }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>TVA </span>
                    <span>{{ Cart::tax() }}</span>
                </div>
                <hr>

                <div class="d-flex justify-content-between">
                    <span>TOTAL </span>
                    <span>{{ Cart::total() }} </span>
                </div>
                <hr>

                  <button type="button" class="btn btn-primary btn-block">go to checkout</button>
            </div>
            
            
        </div>


    </div>
</div>
