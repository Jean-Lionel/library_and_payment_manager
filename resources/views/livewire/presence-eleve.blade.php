<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}


    <style>
        .but {
            background: #1A5684;
            color: #ffffff;
        }
    </style>
    <div class="container align-items-center justify-content-center">
        <div class="col-md-12">

            <h2 class="text-center ">LISTE DE PRESENCE DU {{ now()->format('d-m-Y') }}</h2>
            <div class="d-flex justify-content-center" wire:stream wire:poll.5s>
                <button class="btn btn-sm btn-info mr-2">{{ $countpresence }}</button>
                <button class="btn btn-sm btn-danger">{{ $countabsence }}</button>
            </div>
            <select wire:model.lazy='by_classe' id="by_classe" class="form-control rounded-0 mt-2">
                <option value="0">--Selectionner--</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->name . ' ' . $classe->section->name }}</option>
                @endforeach
            </select>
            <table class="table table-striped mt-2">
                <thead class="but">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Status</th>
                        <th>Classe</th>
                        <th>Section</th>
                        <th>Jour</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listePresence as $key => $presence)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><img src="{{ asset('uploads/eleve/' . $presence->eleve->image_eleve) }}" alt="image"
                                    style="width: 44px; height: 44px; border-radius: 100%;" /></td>
                            <td>{{ $presence->eleve->first_name }}</td>
                            <td>{{ $presence->eleve->last_name }}</td>
                            <td>
                                {{ $presence->status_presence == 1 ? 'P' : 'A' }}
                            </td>
                            <td>{{ $presence->classe->name }}</td>
                            <td>{{ $presence->classe->section->name }}</td>
                            <td>{{ date('d-m-Y', strtotime($presence->created_at)) }}</td>
                            <td>
                                <button class="btn btn-sm btn-info" wire:click="$toggle('showDiv')"><i
                                        class="fa fa-eye text-white"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        @if ($showDiv)
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Mensuel</h1>
                        <div class="row d-flex">
                            <div class="col-3">
                                Presence
                                <div class="bg-success text-white text-center">
                                    <span>6</span>
                                </div>
                            </div>
                            <div class="col-3">
                                Absence
                                <div class="bg-danger text-white text-center">
                                    <span>6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h1>Semestriel</h1>
                        <div class="row d-flex">
                            <div class="col-3">
                                <span> Justifiés</span>
                                <div class="bg-success text-white text-center">
                                    <span class="text-center">2</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <span> Non justifiés</span>
                                <div class="bg-danger text-white text-center">
                                    <span>4</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row d-flex">
                            <div class="col-3">
                                <span>Derangement</span>
                                <div class="bg-secondary text-white text-center">
                                    <span>3</span>
                                </div>
                            </div>

                        <div class="col-3">
                            <span>Impolitesse</span>
                            <div class="bg-info text-white text-center">
                                <span>3</span>
                            </div>
                        </div>

                    </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row d-flex">
                            <div class="col-3">
                                <span>Tricherie</span>
                                <div class="bg-primary text-white text-center">
                                    <span>3</span>
                                </div>
                            </div>
                            <div class="col-3">
                                <span>Exclusion</span>
                                <div class="bg-danger text-white text-center">
                                    <span>3</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
