<div>
    {{-- Stop trying to control. --}}

    <div>
        @if (session()->has('error'))

        <div class="alert alert-danger">
            {{ session('error') }}
        </div>

        @endif
        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

    </div>

    <div class="row">
        <div class="col-md-8">
            <h5 class="text-center">Mes élèves</h5>
            <table class="table table-striped bordered table-sm">
                <thead class="badge-dark">
                    <tr>
                        <th>N°</th>
                        <th>Nom et prénom</th>
                        <th>Section</th>
                        <th>Classe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eleves as $eleve)
                        {{-- expr --}}
                        <tr>
                            <td>{{$eleve->id}}</td>
                            <td>{{$eleve->fullName}}</td>
                            <td>{{$eleve->classe->section->name ?? ""}}</td>
                            <td>{{$eleve->classe->name ?? ""}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                <h5 class="bg-info text-center">Informations</h5>
            </div>

        </div>
        <div class="col-md-4">

         <div class="card" style="width: 25rem;">
            <h5 class="text-center">Vos informations</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between">
                <span> Nom et prénom :</span>
                <span><b>{{ $user->name}}</b></span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                Téléphone : <b>{{$user->telephone}}</b>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                Email : <b>{{ $user->email}}</b>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                <button class="btn btn-link text-center" wire:click="$set('showForm',{{!$showForm}})" >
                Modifier le mot de passe</button>
            </li>

            @if ($showForm)
            {{-- expr --}}
            <li class="list-group-item ">
                <div class="form-group">
                    <label for="">Ancien mot de passe</label>
                    <input type="password" wire:model="oldPassword" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Nouveau mot de passe</label>
                    <input type="password" wire:model="currentPassword" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <label for="">Rettapez votre mot de passe</label>
                    <input type="password" wire:model="newPassword" class="form-control form-control-sm">
                </div>
                <div class="form-group">
                    <button class="btn-info btn-sm btn-block" wire:click="updatePassword">Enregitrer</button>
                </div>
            </li>
            @endif


        </ul>
    </div>

</div>

<div class="col-md-8">

    @if ($paiements)
        {{-- expr --}}
        <div>
            <div class="bg-dark">Paiement</div>

            <table class="table table-sm table-hover table-stipped">
                <thead class="badge-dark">
                    <tr>
                        <th>#</th>
                        <th>Bordereau</th>

                        <th>TYPE</th>
                        <th>Trimestre</th>
                        <th>A\S</th>
                        <th>Montant</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($paiements as $key => $paiement)
                        {{-- expr --}}
                        @if ( $paiement[0])
                            {{-- expr --}}
                             <tr>
                            <td colspan="5" class="bg-info text-center">
                               <b>{{ ++$key }} # {{ $paiement[0]->eleve->fullName}} </b>
                            </td>
                        </tr>
                        @endif

                        @foreach ($paiement as $p)

                         <tr>
                            <td>{{ $p->id}}</td>
                            <td>{{ $p->bordereau}}</td>
                            <td>{{ $p->type_paiement}}</td>
                            <td>{{ $p->trimestre}}</td>
                            <td>{{ $p->annee_scolaire}}</td>
                            <td>{{ $p->amount}}</td>
                            <td>{{ $p->created_at}}</td>
                        </tr>

                        @endforeach

                    @endforeach
                </tbody>
            </table>


        </div>
    @endif

</div>

<div class="container">
    <div class="row">
        <div class="col-4">

        </div>
        <div class="col-6">

        </div>
    </div>
</div>


</div>
