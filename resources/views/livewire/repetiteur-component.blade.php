<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    <form wire:submit.prevent="SaveRepetiteur" enctype="multipart/form-data">
        {{-- stepone --}}
        @if ($currentStep == 1)
            <div class="step-one">
                <div class="card">
                    <div class="card-header bg-info text-white">STEP 1/4 - Personal Details</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="nom_repetiteur">Nom</label>
                                    <input type="text" class="form-control rounded-0" wire:model='nom_repetiteur'
                                        placeholder="Entrer  nom">
                                    <span class="text-danger">
                                        @error('nom_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prenom_repetiteur">Prenom</label>
                                    <input type="text" class="form-control rounded-0" wire:model='prenom_repetiteur'
                                        placeholder="Entrer prenom">
                                    <span class="text-danger">
                                        @error('prenom_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Post nom</label>
                                    <input type="text" class="form-control rounded-0" wire:model='postnom_repetiteur'
                                        placeholder="Entrer postnom">
                                    <span class="text-danger">
                                        @error('postnom_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Sexe</label>
                                    <select class="form-control rounded-0" wire:model='sexe_repetiteur'>
                                        <option value="" selected>--Selectionner--</option>
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('sexe_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Carte Identité</label>
                                    <input type="text" class="form-control rounded-0"
                                        wire:model='carte_identite_repetiteur' placeholder="Numero Identite">
                                    <span class="text-danger">
                                        @error('carte_identite_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Date naissaince</label>
                                    <input type="date" class="form-control rounded-0"
                                        wire:model='date_naissance_repetiteur' placeholder="Entrer Date naissance">
                                    <span class="text-danger">
                                        @error('date_naissance_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        @endif

        {{-- steptwo --}}
        @if ($currentStep == 2)
            <div class="step-two mt-2">
                <div class="card">
                    <div class="card-header bg-info text-white">STEP 2/4 - Adresse Details</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Telephone</label>
                                    <input type="text" wire:model='telephone_repetiteur'
                                        class="form-control rounded-0" placeholder="Entrer N° Téléphone">
                                    <span class="text-danger">
                                        @error('telephone_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control rounded-0" wire:model='email_repetiteur'
                                        placeholder="Entrer adresse email">
                                    <span class="text-danger">
                                        @error('email_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Ville ou Territoire</label>
                                    <input type="text" class="form-control rounded-0" wire:model='territoire'
                                        placeholder="Entrer Ville ou Territoire">
                                    <span class="text-danger">
                                        @error('territoire')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Quartier ou Colline</label>
                                    <input type="text" class="form-control rounded-0" wire:model='quartier'
                                        placeholder="Entrer Quartier ou Colline">
                                    <span class="text-danger">
                                        @error('quartier')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Avenue</label>
                                    <input type="text" wire:model='avenue' class="form-control rounded-0"
                                        placeholder="Entrer avenue">
                                    <span class="text-danger">
                                        @error('avenue')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- step-fre --}}
        @if ($currentStep == 3)
            <div class="step-free mt-2">
                <div class="card">
                    <div class="card-header bg-info text-white">STEP 3/4 - Framework</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Photo</label>
                                    <input type="file" class="form-control rounded-0"
                                        wire:model='photo_repetiteur' />
                                    <span class="text-danger">
                                        @error('photo_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Temps expérience</label>
                                    <input class="form-control rounded-0" wire:model='experience' />
                                    <span class="text-danger">
                                        @error('experience')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea class="form-control rounded-0" wire:model='description_repetiteur' cols="2" rows="2"
                                        placeholder="Decrire votre repetiteur"></textarea>
                                    <span class="text-danger">
                                        @error('description_repetiteur')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Nam obcaecati officia, quidem ipsa, voluptate tempora nulla veniam nisi fugiat quasi
                        recusandae magni a doloribus consequatur magnam non unde earum repudiandae.
                        <div class="cours d-flex flex-column aligh-items-left mt-2">
                            <label for="laravel">
                                <input type="checkbox" id="laravel" wire:model='cours' value="laravel"> Laravel
                            </label>
                            <label for="laravel">
                                <input type="checkbox" id="React" wire:model='cours' value="React"> React js
                            </label>
                            <label for="laravel">
                                <input type="checkbox" id="Flutter" wire:model='cours' value="Flutter"> Flutter
                            </label>
                        </div>
                        <span class="text-danger">
                            @error('cours')
                                {{ $message }}
                            @enderror
                        </span>

                    </div>
                </div>
            </div>
        @endif
        {{-- step four --}}
        @if ($currentStep == 4)
            <div class="step-four mt-2">
                <div class="card">
                    <div class="card-header bg-secondary text-white">STEP 3/4 - Framework</div>
                    <div class="card-body">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quisquam eum, quod vitae corrupti ratione iure tempora ullam nostrum laborum dignissimos,
                        eos voluptatem obcaecati asperiores, laboriosam exercitationem blanditiis.
                        Eveniet, eius maxime?

                    </div>
                </div>
            </div>
        @endif
        <div class="action-buttons d-flex justify-content-between bg-white pt-2 pb-2">
            @if ($currentStep == 1)
                <div></div>
            @endif
            @if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
                <button type="button" class="btn btn-sm btn-secondary" wire:click="decreaseSted()">Back</button>
            @endif
            @if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
                <button type="button" class="btn btn-sm btn-info" wire:click="increaseSted()">Next</button>
            @endif
            @if ($currentStep == 4)
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            @endif

        </div>
    </form>
    @canany(['is-admin', 'is-prefet'])
        <div class="container mt-5">
            <div class="col-md-12">
                <input type="text" placeholder="rechercher" class="form-control rounded-0" wire:model="search">
                <table class="table table-striped mt-2">
                    <thead class="bg-info text-white">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Sexe</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Territoire</th>
                            <th>Quartier</th>
                            <th>Avenue</th>
                            <th>Experience</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($repetiteur as $key => $repe)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $repe->nom_repetiteur }}</td>
                                <td>{{ $repe->prenom_repetiteur }}</td>
                                <td>{{ $repe->sexe_repetiteur }}</td>
                                <td>{{ $repe->email_repetiteur }}</td>
                                <td>{{ $repe->telephone_repetiteur }}</td>
                                <td>{{ $repe->territoire }}</td>
                                <td>{{ $repe->quartier }}</td>
                                <td>{{ $repe->avenue }}</td>
                                <td>{{ $repe->experience }}</td>
                                <td>
                                    <button class="btn-sm btn-primary"><i class="fa fa-pencil text-white"></i></button>
                                    <button class="btn-sm btn-danger"><i class="fa fa-trash text-white"></i></button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="float-right">
                {{ $repetiteur->links() }}
            </div>
        </div>
        @endcanany
    </div>
