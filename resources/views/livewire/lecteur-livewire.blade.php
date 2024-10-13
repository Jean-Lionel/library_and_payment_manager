<div>
    {{-- The whole world belongs to you --}}

    <div class="container pt-5 border px-5 py-5  border-dark bg-white mt-4">
        <div class="row">


            <div class="col-md-3">
                <h5 class="text-center">Nouveau lecteur</h5>
                <form action="" wire:submit.prevent="saveLecteur()">

                    <div class="form-group">
                        <label for="">NOM ET PRENOM</label>
                        <input class="form-control rounded-0" type="text" wire:model="name">
                        @error('name')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror

                    </div>


                    <div class="form-group">
                        <label for="">TELEPHONE</label>
                        <input class="form-control rounded-0" type="text" wire:model="telephone">
                        @error('telephone')
                            <span class="error text-danger">{{ $message }}</span>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label>DESCRIPTION</label>

                        <textarea wire:model="description" class="form-control"></textarea>
                    </div>

                    <div class="form">
                        <button type="submit" class="btn btn-sm btn-success w-100 rounded-0">Enregistrer</button>
                    </div>

                </form>

            </div>

            <div class="col-md-9">
                <h4 class="text-center">Liste des lecteurs</h4>
                 <input type="" wire:model="search" placeholder="rechercher ici !!" name="">

                <table class="table mt-2">
                    <thead>
                        <tr>
                            <th>Num</th>
                            <th>NOM ET PRENOM</th>
                            <th>TELEPHONE</th>
                            <th>DATE</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($lecteurs as $lecteur)
                            <tr>
                                <td>{{ $lecteur->id }}</td>
                                <td>{{ $lecteur->name }}</td>
                                <td>{{ $lecteur->telephone }}</td>
                                <td>{{ $lecteur->created_at }}</td>
                                <td><button class="btn-info"
                                        wire:click="updateLecteur({{ $lecteur->id }})">Modifier</button></td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="5">Pas de lecteurs enregistré</td>
                            </tr>
                        @endforelse
                    </tbody>


                </table>

                {{ $lecteurs->links() }}
            </div>
        </div>
    </div>
</div>
