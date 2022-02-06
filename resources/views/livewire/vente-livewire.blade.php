<div>
    {{-- Do your work, then step back. --}}

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
                    @if($product->quantite < 10)
                    <tr class="bg-danger">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->marque }}</td>
                        <td>{{ $product->category->name ?? "" }}</td>
                        <td>{{ $product->quantite }}</td>
                        <td>{{  getPrice($product->price) }}</td>
                        <td>
                            @if(!searchProduct( $product->id) and $product->quantite > 0 )
                            <button wire:click="addToCart({{$product->id  }})" class="btn btn-sm btn-info" style="font-size:15px"> <i class="fa fa-plus"></i></button>
                            @else
                                <i class="fa fa-check"></i>

                            @endif
                            
                        </td>
                    </tr>

                    @else

                    <tr class="">
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->marque }}</td>
                        <td>{{ $product->category->name ?? "" }}</td>
                        <td>{{ $product->quantite }}</td>
                        <td>{{  getPrice($product->price) }}</td>
                        <td>
                            @if(!searchProduct( $product->id) and $product->quantite > 0 )
                            <button wire:click="addToCart({{$product->id  }})" class="btn btn-sm btn-info" style="font-size:15px"> <i class="fa fa-plus"></i></button>
                            @else
                                <i class="fa fa-check"></i>

                            @endif
                            
                        </td>
                    </tr>

                    @endif

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
                                   
                                    <p class="text-dark">{{ $cartItem->model->name ?? "" }}</p>
                                        
                                </td>

                                <td>

                                    <input type="number" min="0" class="form-control {{ $inputFormControl }}" wire:keydown.enter="updateQuantite($event.target.value, '{{ $cartItem->rowId }}')" value="{{ $cartItem->qty }}">
                                 {{--    <input type="text"  wire:keydown="updateQuantite($event.target.value,{{  $cartItem->rowId }})" value="{{ $cartItem->qty }}"> --}}
                                </td>

                                <td>
                                    {{ getPrice($cartItem->model->price ?? 0, "") }}
                                </td>
                                <td>
                                    {{ getPrice($cartItem->subtotal() ?? 0, "") }}
                                </td>
                                <td>
                                    <button wire:click="removeItem('{{ $cartItem->rowId }}')">Supprimer</button>
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
                    <span>{{ getPrice(Cart::subtotal()) }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <span>TVA </span>
                    <span>{{ getPrice(Cart::tax()) }}</span>
                </div>
                <hr>

                <div class="d-flex justify-content-between">
                    <span>TOTAL </span>
                    <span>{{ getPrice(Cart::total()) }} </span>
                </div>
                <hr>
                <input type="text" wire:model="client_name" placeholder="Nom du client">
                <hr>
                  <button wire:click="storeInvoice()" type="button" class="btn btn-primary btn-block">Payement</button>
            </div>
        </div>

        <div class="col-md-12">
            @if ($printOrder)
               <div id="facture">
                   <div class="header-facture">
                       <h4>FACTURE </h4>
                   </div>
                   <div>
                    <table class="table-sm table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DESCRIPTION</th>
                                <th>Qté</th>
                                <th>P U</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->detailsOrders as $product)
                            <tr>
                                <td>2</td>
                                <td>{{ $product->product->name }}</td>
                                <td>{{ $product->quantite }}</td>
                                <td>{{ $product->price_unitaire }}</td>
                                <td>{{ $product->montant }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                       
                   </div>
               </div>
            @endif
            
            @if($order)
            <table class="table-sm table table-striped">
                <thead class="badge-info">
                    <tr>
                        <th>CLIENT</th>
                        <th>PHTVA</th>
                        <th>TVA</th>
                        <th>TOTAL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->client }}</td>
                        <td>{{ getPrice($order->amount_tax) }}</td>
                        <td>{{ getPrice($order->tax) }}</td>
                        <td>{{ getPrice($order->montant) }}</td>
                        <td>
                            <button wire:click="$set('printOrder','{{ !$printOrder  }}')">Imprimer</button>
                        </td>         
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
