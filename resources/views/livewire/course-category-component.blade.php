<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    @if($showForm)
    <div>
        <form wire:submit.prevent="saveCouseCategory">
            <label for="">CATEGORIE</label>
            <input type="text" wire:model="name">
            @error('name')
            <span class="text-danger">{{$message }}</span>
            @enderror
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
                    <th>DESCRIPTION</th>
                    <th>ACTION</th>
                </tr>
            </thead>

            <tbody>
                @foreach ( $categories as $key=>$category)
                    {{-- expr --}}
                    <tr>
                        <td>{{ ++$key}}</td>
                        <td>{{  $category->name}}</td>
                        <td>
                            <button wire:click="editCategory({{ $category}})"><i class="fa fa-edit"></i> Modifier</button>
                        </td>
                    </tr>

                    @if($selectId ==$category->id )
                    <tr>
                        <td></td>
                        <td>
                            <form wire:submit.prevent="saveCouseCategory">
                        
                                <input type="text" wire:model="name">
                                @error('name')
                                <span class="text-danger">{{$message }}</span>
                                @enderror
                                <button>Modifier</button>
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
