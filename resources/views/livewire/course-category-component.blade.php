<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    @if($showForm)
    <div>
        <form wire:submit.prevent="saveCouseCategory">

            <div class="form-group">
                <label for="ordre">Ordre</label>
                 <input type="text" wire:model="ordre">
                    @error('ordre')
                    <span class="text-danger">{{$message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Categorie</label>
                <input type="text" wire:model="name">
                @error('name')
                <span class="text-danger">{{$message }}</span>
                @enderror
            </div>


            
            <button>Enregistrer</button>
        </form>     
    </div>
    @endif

    <div>
        <input type="text" wire:model="search" placeholder="Rechercher ici">
        <button wire:click="openForm"><i class="fa fa-plus"></i></button>
        <table class="table-sm table-hover table">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>ORDRE</th>
                    <th>DESCRIPTION</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                @foreach ( $categories as $key=>$category)
                {{-- expr --}}
                <tr>
                    <td>{{ ++$key}}</td>
                    <td>{{ $category->ordre}}</td>
                    <td>{{  $category->name}}</td>
                    <td>
                        <button wire:click="editCategory({{ $category}})"><i class="fa fa-edit"></i> Modifier</button>
                    </td>
                </tr>

                @if($selectId ==$category->id )
                <tr>
                    <td></td>
                    <td>
                        <form class="d-flex justify-content-between" wire:submit.prevent="saveCouseCategory">

                            <div>
                                <input type="text" wire:model="ordre">
                            </div>
                            <div>
                                <input type="text" wire:model="name">
                                @error('name')
                                <span class="text-danger">{{$message }}</span>
                                @enderror
                            </div>
                            <div>
                                <button>Modifier</button>
                            </div>

                            
                            
                        </form>   
                    </td>
                    <td></td>

                </tr>
                @endif
                @endforeach
            </tbody>
            
        </table>

        {{ $categories->links()}}
    </div>

</div>
