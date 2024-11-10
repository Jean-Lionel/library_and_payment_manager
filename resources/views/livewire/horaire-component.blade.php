<div>
    <style>
        .btn {
            background: #1A5684;
            color: #ffffff;
        }

        .head {
            background: #1A5684;
            color: #ffffff;
        }
    </style>

    @can('is-admin')
        <div class="container pt-5 border px-5 py-5  border-dark bg-white">
            <button class="btn btn-sm text-white float-right" wire:click="$toggle('showDiv')">Nouveau Horaire</button>
            <input type="search" placeholder="Rechercher par le nom" wire:model.live.debounce.300ms="search" />

            <table class="table table-striped w-100 mt-2">
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Heure</th>
                        <th>Cours</th>
                        {{-- <th>Enseignant</th> --}}
                        <th>Classe</th>
                        <th>Section</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getHoraire as $horaire)
                        <tr>
                            <td>{{ $horaire->jour }}</td>
                            <td>{{ $horaire->heure }}</td>
                            <td>{{ $horaire->cours }}</td>
                            {{-- <td>{{ $horaire->user->name }}</td> --}}
                            <td>{{ $horaire->classe->name }}</td>
                            <td>{{ $horaire->classe->section->name }}</td>
                            <td>
                                <button type="button" class="btn-sm btn-danger text-white"
                                    wire:click="deleteId({{ $horaire->id }})" data-toggle="modal"
                                    data-target="#exampleModal"><i class="fa fa-trash"></i></button>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">
                {{ $getHoraire->links() }}
            </div>
            {{-- modal to confirm delete --}}
            <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true close-btn">×</span>

                            </button>

                        </div>

                        <div class="modal-body">

                            <p>Are you sure want to delete?</p>

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>

                            <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                                data-dismiss="modal">Yes, Delete</button>

                        </div>

                    </div>

                </div>

            </div>
            {{-- fin modal confirm --}}
        </div>
    </div>
@endcan
@if ($showDiv)
    @canany(['is-admin', 'is-prefet'])
        <div class="container pt-5 border px-5 py-5  border-dark bg-white mt-2">
            <h3 class="text-center text-uppercase">Ajouter horaire</h3>

            <form action="" wire:submit.prevent="saveHoraire">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="classe">Jour</label>
                        <select wire:mode="jour" class="form-control rounded-0" id="jour">
                            <option value="null">--Selectionner--</option>
                            <option value="lundi">Lundi</option>
                            <option value="mardi">Mardi</option>
                            <option value="mercredi">Mercredi</option>
                            <option value="jeudi">Jeudi</option>
                            <option value="vendredi">Vendredi</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="classe">Classe</label>
                        <select wire:model="classe" id="classe" class="form-control rounded-0">
                            <option value="null">--Selectionner--</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id . '#' . $class->name }}">{{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="heure">Heure</label>
                        <input type="number" wire:model="heure" class="form-control rounded-0" id="heure" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="heure">Intervalle</label>
                        <input type="text" wire:model="intervalle" class="form-control rounded-0" id="intervalle" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cours">Cours</label>
                        <input type="text" wire:model="cours" class="form-control rounded-0" id="cours" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="teacher">Enseignant</label>
                        <select class="form-control rounded-0" wire:model="teacher" id="teacher">
                            <option value="null">--Selectionner--</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id . '#' . $user->name }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button id="btn_save" type="button" class="btn btn-sm float-right w-100">Ajouter</button>
            </form>


        </div>


        <div class="container tabledata mt-3 card--container">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th> Jour </th>
                        <th> Heure </th>
                        <th> Classe </th>
                        <th> Intervalle </th>
                        <th> Cours </th>
                        <th> Enseignant </th>

                    </tr>
                </thead>
                <tbody id="body_table">

                </tbody>
            </table>
            <button type="submit" class="btn btn-sm float-right" id="save_info">Enregistrer</button>
            {{-- <div class="d-flex">
                        {!! $formation->links() !!}
                    </div> --}}
        </div>
    @endcanany
@endif


@canany(['is-prefet', 'is-professeur'])
    {{-- <div class="mt-2 horaire-table">
            <h3 class="text-center">Horaire</h3>
            <table class="table">
                <thead class="head">
                    <tr>
                        <th>Heure</th>
                        <th>Intervalle</th>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                        <th>Samedi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="head">1Heure</td>
                        <td>7H30-8H15</td>
                        <td>Anglais</td>
                        <td>Mathematique</td>
                        <td>Esthetique</td>
                        <td>Mathe Fin</td>
                        <td>Mecanique</td>
                        <td rowspan="3">Projet</td>
                    </tr>
                    <tr>
                        <td class="head">2Heure</td>
                        <td>7H30-8H15</td>
                        <td>Francais</td>
                        <td>Dessin</td>
                        <td>Biologie</td>
                        <td>Religion</td>
                        <td>Physique</td>

                    </tr>
                    <tr>
                        <td class="head">3Heure</td>
                        <td>7H30-8H15</td>
                        <td>Physique</td>
                        <td>Religion</td>
                        <td>Dessin</td>
                        <td>Sport</td>
                        <td>Chimie</td>

                    </tr>
                    <tr class="head">
                        <td colspan="8" class="text-center">RECREATION</td>
                    </tr>
                    <tr>
                        <td class="head">4Heure</td>
                        <td>7H30-8H15</td>
                        <td>Botanique</td>
                        <td>Chimie</td>
                        <td>Comptabilite</td>
                        <td>Pegagogie</td>
                        <td>ECM</td>
                        <td rowspan="2">PROJET</td>
                    </tr>
                    <tr>
                        <td class="head">5Heure</td>
                        <td>7H30-8H15</td>
                        <td>Musique</td>
                        <td>Histoire</td>
                        <td>Informatique</td>
                        <td>Sport</td>
                        <td>Ethique</td>

                    </tr>
                    <tr>
                        <td class="head">6Heure</td>
                        <td>7H30-8H15</td>
                        <td>Technologie</td>
                        <td>Geographie</td>
                        <td>Francais</td>
                        <td>Analyse Math</td>
                        <td>Sport</td>

                    </tr>
                </tbody>
            </table>
        </div>  --}}
    <div class="container bg-white mt-2">
        <h2 class="text-center ">Horaire du {{ now()->format('d-m-Y') }}</h2>
        <select wire:model.lazy='by_day' id="by_day" class="form-control rounded-0 mt-2">
            <option value="0">--Selectionner classe--</option>
            <option value="lundi">lundi</option>
            <option value="mardi">mardi</option>
            <option value="mercredi">mercredi</option>
            <option value="jeudi">jeudi</option>
            <option value="vendredi">vendredi</option>
        </select>
        <table class="table table-striped w-100 mt-2">
            <thead class="head">
                <tr>
                    <th>Heure</th>
                    <th>Intervalle</th>
                    <th>Classe</th>
                    <th>Section</th>
                    <th>Cours</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($selecthoraire as $horaire)
                    <tr>
                        <td class="head">{{ $horaire->heure }} <small>ieme Heure</small></td>
                        <td>{{ $horaire->intervalle }}</td>
                        <td>{{ $horaire->classe->name }}</td>
                        <td>{{ $horaire->classe->section->name }}</td>
                        <td>{{ $horaire->cours }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endcanany
</div>
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            let listeHoraire = [];
            //Generate table of data with ajax
            $('#btn_save').on('click', function(e) {
                e.preventDefault();

                alert($('#teacher').val())
                //Designation Qte P.U HTVA  P.V N° Lot
                const entry = {
                    jour: $('#jour').val(),
                    classe: $('#classe').val().split('#')[0],
                    nom_classe: $('#classe').val().split('#')[1],
                    heure: $('#heure').val(),
                    intervalle: $('#intervalle'),
                    cours: $('#cours').val(),
                    teacher: $('#teacher').val().split('#')[0],
                    nom_teacher: $('#teacher').val(),
                }
                listeHoraire.push(entry)

                console.log(entry)
                let trs = "";
                for (const el of listeHoraire) {
                    trs += `
                                    <tr>
                                    <td>${el.jour}</td>
                                    <td>${el.classe}</td>
                                     <td>${el.classe}</td>
                                     <td>${el.heure}</td>
                                     <td>${el.intervalle}</td>
                                    <td>${el.cours}</td>
                                    <td>${el.nom_teacher.split('#')[1]} </td>

                                    </tr>
                                    `
                }

                $('#body_table').html(trs)
            });

            //to save data in database

            $("#save_info").on('click', function(e) {
                e.preventDefault();
                const t = JSON.stringify(listeHoraire)
                console.log(t)
                $.ajax({
                    url: '{{ route('horaire.create') }}',
                    type: 'post',
                    data: {
                        t: t,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data)
                        $('#cours').val('')
                        $('#heure').val('')
                        $('#intervalle').val('')
                        $('#teacher').val('')
                        $('#classe').val('')
                        $('#jour').val('')
                    }
                });
                // window.location.reload();
            })
        });
    </script>
@endpush
