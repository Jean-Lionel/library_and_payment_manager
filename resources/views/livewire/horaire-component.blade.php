<div>
    <div class="container">
        <h3>Ajouter horaire</h3>
        <div class="row">
            <form action="" wire:submit.prevent="saveHoraire">
                <div class="form-group">
                    <label for="classe">Jour</label>
                    <select  wire:mode="jour" class="form-control rounded-0" id="jour">
                        <option value="null">--Selectionner--</option>
                        <option value="lundi">Lundi</option>
                        <option value="mardi">Mardi</option>
                        <option value="mercredi">Mercredi</option>
                        <option value="jeudi">Jeudi</option>
                        <option value="vendredi">Vendredi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="classe">Classe</label>
                    <select wire:model="classe" id="classe" class="form-control rounded-0">
                        <option value="null">--Selectionner--</option>
                        @foreach ($classes as $class )
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="heure">Heure</label>
                        <input type="number" wire:model="heure" class="form-control rounded-0" id="heure" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="cours">Cours</label>
                        <input type="text" wire:model="cours" class="form-control rounded-0" id="cours"/>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="teacher">Enseignant</label>
                        <select class="form-control rounded-0" wire:model="teacher" id="teacher">
                            <option value="null">--Selectionner--</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button id="btn_save" type="button" class="bt btn-sm btn-info float-right w-100">Ajouter</button>
            </form>
        </div>

    </div>


                <div class="tabledata mt-3 card--container">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th> Jour </th>
                                <th> Heure </th>
                                <th> Classe </th>
                                <th> Cours </th>
                                <th> Enseignant </th>
                            </tr>
                        </thead>
                        <tbody id="body_table">

                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-sm btn-info float-right" id="save_info">Enregistrer</button>
                    {{-- <div class="d-flex">
                        {!! $formation->links() !!}
                    </div> --}}
                </div>



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
                console.log();
                //Designation Qte P.U HTVA  P.V N° Lot
                const entry = {
                    jour: $('#jour').val(),
                    classe: $('#classe').val().split('#')[0],
                    nom_classe: $('#classe').val().split('#')[1],
                    heure: $('#heure').val(),
                    cours: $('#cours').val(),
                    teacher: $('#teacher').val().split('#')[0],
                    nom_teacher: $('#teacher').val().split('#')[1],
                }
                listeHoraire.push(entry)
                let trs = "";
                for (const el of listeHoraire) {
                    trs += `
                                    <tr>
                                    <td>${el.jour}</td>
                                    <td>${el.classe}</td>
                                     <td>${el.classe}</td>
                                    <td>${el.cours}</td>
                                    <td>${el.teacher}</td>

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
