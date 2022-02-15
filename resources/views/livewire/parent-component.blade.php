<div>
    {{-- Because she competes with no one, no one can compete with her. --}}

    @if ($showForm)
    {{-- expr --}}
    <div class="row">
        <form action="" wire:submit.prevent="saveParent" class="offset-3 col-md-6 row">
            <h4 class="text-center col-md-12">Nouveau Parent</h4>
            <div class="form-group col-md-6">
                <label for="nom">Nom</label>
                <input type="text" wire:model="firstName" class="form-control form-control-sm" id="nom">
                @error('firstName')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="prenom">Prénom</label>
                <input type="text" wire:model="lastName" class="form-control form-control-sm" id="prenom">
                @error('lastName')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="telephone">Télephone</label>
                <input type="text" wire:model="telephone" class="form-control form-control-sm" id="telephone">
                @error('telephone')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" required wire:model="email" class="form-control form-control-sm" id="email">
                @error('email')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="address">Address</label>
                <input type="text" wire:model="address" class="form-control form-control-sm" id="address">
                @error('address')
                <span class="error text-danger">{{ $message }}</span>
                @enderror
            </div> 
            <div class="form-group col-md-6">
                <label for="address"></label>
                <button type="submit" class="btn-sm btn-block btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
    @else
    <div>
        <div class="row">
            <div class="col-md-4">
                <h5>Liste des parents</h5>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control form-control-sm">
            </div>
            <div class="col-md-1 text-right">
                <button class="btn-sm btn-block btn-primary" wire:click="$set('showForm',true)"> 
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <table class="table table-sm table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Tél</th>
                    <th>E-mail</th>
                    <th>Enfant</th>
                    <th>Action</th>
                </tr>
                
            </thead>
            <tbody>

                @forelse ($parents as $parent)
                    {{-- expr --}}
                    <tr>
                        <td>{{ ++$loop->index
                         }}</td>
                        <td>{{ $parent->firstName }}</td>
                        <td>{{ $parent->lastName }}</td>
                        <td>{{ $parent->telephone }}</td>
                        <td>{{ $parent->email }}</td>
                        <td></td>
                        <td>
                            <span style="cursor: pointer;" class=" btn-sm btn-link" wire:click="modifierParent({{$parent->id}})">Modifier</span>

                             <span wire:click="choosedParent({{$parent->id}})" style="cursor: pointer;" class=" btn-sm btn-link">Asscociér à son élève</span>
                        </td>
                    </tr>

                    @if ($selectedParent == $parent->id)
                        {{-- expr --}}
                        <tr>
                            <td colspan="7">
                                <div>
                                    <livewire:associer-enfant :parent="$parent->id" />
                                </div>
                            </td>
                        </tr>
                    @endif

                @empty
                    {{-- empty expr --}}
                    Pas des parents enregistrés
                @endforelse
            </tbody>
        </table>

        {{ $parents->links() }}
    </div>
    @endif
</div>
