<div>
    {{-- Success is as dangerous as failure. --}}
    <style>
        .bc {
            border: solid 1px;
            background: red;
            color: white;
            border-radius: 20px;
        }
    </style>
    <div class="row">
        <div class="col-md-3">
            <select name="" wire:model="selectedSection" id="" class="form-control">
                <option value="">Choisissez une section</option>

                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <div class="form-group">

                <select name="selectedClasse" wire:model="selectedClasse" id="" class="form-control">
                    <option value="">Choisissez une classe</option>

                    @foreach ($classes as $classe)
                        <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <input type="text" wire:model="searchKey" placeholder="Rechercher ici " class="form-control">
        </div>

        @canany(['is-admin', 'is-professeur'])
            <div class="col-md-3">
                <a class="btn-primary btn btn-block" href="#"><i class="i
                fa fa-print"></i></a>
            </div>
        @endcanany
    </div>

    <div class="tabledata mt-3 card--container">
        <table class="table table-bordered table-sm ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Numéro de compte</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Adresse</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eleves as $key => $eleve)
                    <tr>

                        <td>{{ ++$key }}</td>
                        <td><img src="{{ asset('uploads/eleve/' . $eleve->image_eleve) }}" alt="image"
                                style="width: 44px; height: 44px; border-radius: 100%;" /></td>
                        <td>{{ $eleve->compte->name ?? '' }}</td>
                        <td>{{ $eleve->first_name }}</td>
                        <td>{{ $eleve->last_name }}</td>
                        <td>{{ $eleve->sexe }}</td>
                        <td>{{ $eleve->address }}</td>
                        <td class="d-flex ">
                            <a href="{{ route('punition_create', $eleve->id)}}" class="btn btn-link"  > Punition</a>
                           
                            <!-- <button wire:click.prevent="Retard({{ $eleve->id }})"
                                class="btn-sm btn-info mr-2">Retard</button>
                            <button wire:click.prevent="Derangement({{ $eleve->id }})"
                                class="btn-primary btn-sm mr-2">Derangeur</button>
                            <button wire:click.prevent="Trouble({{ $eleve->id }})"
                                class="btn btn-secondary btn-sm text-white mr-2">Trouble</button>
                            <button wire:click.prevent="Impoli({{ $eleve->id }})"
                                class="btn btn-warning btn-sm text-white mr-2">Impoli</button>
                            <button wire:click.prevent="Tricherie({{ $eleve->id }})"
                                class="btn btn-danger btn-sm text-white mr-2">Tricherie</button>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exclusion" wire:click.prevent='getEleveById({{$eleve->id}})'>
                                Exclusion
                            </button> -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            <div class="modal fade" id="exclusion" tabindex="-1" aria-labelledby="exclusionLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="exclusionLabel">Nouvelle Exclusion</h5>
                            <button type="button" class="btn-close bc" data-bs-dismiss="modal"
                                aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent='exclure'>
                                <div class="form-group">
                                    <label for="duree">Durée</label>
                                    <input type="hidden" id="duree" placeholder="durée"
                                        class="form-control rounded-0" wire:model="eleve_id" />
                                </div>
                                <div class="form-group">
                                    <label for="duree">Durée</label>
                                    <input type="number" wire:model="duree" id="duree" placeholder="durée"
                                        class="form-control rounded-0" />
                                </div>
                                <div class="form-group">
                                    <label for="motif">Motif</label>
                                    <input type="text" placeholder="motif exclusion" id="motif" wire:model="motif"
                                        class="form-control rounded-0" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger text-white"
                                data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{ $eleves->links() }}
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
