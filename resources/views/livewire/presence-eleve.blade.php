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
            <table class="table table-striped">
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
                    {{ $i = 1 }}
                    @foreach ($listePresence as $presence)
                        <tr>
                            <td>{{ $i++ }}</td>
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
                                <button class="btn btn-sm btn-info" wire:click="$toggle('showDiv')"><i class="fa fa-eye text-white"></i></button>
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
                    <h1>Rapport Eleve</h1>
                    <div class="row d-flex">
                    <div class="col-3">
                        Presence
                    </div>
                    <div class="col-3">
                        Absence
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                    <h1>Details ponctualités</h1>
                    <div class="row d-flex">
                    <div class="col-3">
                        Justifiés
                    </div>
                    <div class="col-3">
                        Non justifiés
                    </div>
                </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
