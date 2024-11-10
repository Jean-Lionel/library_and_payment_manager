<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <style>
        .btn {
            background: #1A5684 !important;
            color: #ffffff;
            border: none
        }
    </style>
    <h2 class="text-uppercase text-center">Cliquer sur l'opération à effectuer ou consulter</h2>
    <div class="row mb-3">

        <div class="container d-flex justify-content-center align-items-center mt-4">
            <div class="col-md-3">
                <a href="{{ route('paiements.create') }}" class="btn btn-lg">Rapport Paiement</a>
            </div>
            <div class="col-md-3">
                <button wire:click="showForm" class="btn  btn-lg"> Nouveau Paiement</button>
            </div>
            <div class="col-md-3">
                <button wire:click="$toggle('echeanceToggle')" class="btn btn-lg">Echéances Paiement</button>
            </div>
            <div class="col-md-3">
                <button wire:click="showEnOrdre" class="btn btn-lg"> Historique Paiement</button>
            </div>

        </div>
        {{-- Impression du recu --}}

        @if ($facture and $showFacture)
            <div class="mt-4 d-flex justify-content-center w-100">
                <div>
                    <div class="mb-3">
                        <button onclick="clickButton('main-content')" class="btn p-1 m-0 border border-dark"><span
                                style="color:green">🖨</span> Imprimer</button>
                        <button wire:click="closeBill" class="btn p-1 m-0 border border-dark"> ❌ Fermer</button>
                    </div>
                    <div class="main-content jumbotron d-none" id="main-content">
                        <header>
                            <h4>ECOLE : XXXX XXXX</h4>
                            <h4>A/S : {{ $facture->annee_scolaire ?? '' }}</h4>
                            <h4 style="text-align: center;">RECU N° {{ $facture->id }}</h4>
                            <hr>
                        </header>
                        <section>
                            <p>Bordereau N° : {{ $facture->bordereau }} </p>
                            <p>Classe : {{ $facture->eleve->classe->name }}</p>

                            <p>Compte de l'élève : {{ $facture->compte_name }} </p>
                            <p>Nom et prénom : {{ $facture->eleve->fullName }}</p>
                            <p>Montant Payé : {{ $facture->amount }} <br>
                                Nous disons : <span id="montant_lettre">
                                    {{ $number_letter }}
                                </span>
                            </p>
                            <p>FRAIS : {{ $facture->type_paiement }} DU {{ $facture->trimestre }}</p>

                            <div style="display: flex;justify-content: space-between;">
                                <p>Signature de l'élève</p>
                                <p>Signature du caissier</p>

                            </div>

                            <p style="text-align: center;">
                                Date : {{ $facture->created_at }}
                            </p>
                        </section>
                    </div>
                </div>
            </div>
        @endif


        {{-- Apres l'Impression du recu --}}

        @if ($showFormulaire)
            <div class="container pt-5 border px-5 py-5  border-dark bg-white mt-3">
                <h4 class="text-center text-uppercase">Nouveau paiement</h4>
                <form wire:submit.prevent="savePaiement">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="compte_name">COMPTE</label>
                            <input class="form-control rounded-0" type="text" wire:model="compteName">
                            @if ($eleve and $compteName)
                                <div class="col-md-12 mt-2 ">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            Nom et Prénom : <b>{{ $eleve->first_name . ' ' . $eleve->last_name }} </b>
                                        </li>
                                        <li class="list-group-item">
                                            COMPTE : <b>{{ $eleve->compte->name }}</b>
                                        </li>
                                        <li class="list-group-item">
                                            <span>CLASSE : {{ $eleve->classe->name }}</span>

                                        </li>
                                    </ul>

                                </div>
                            @endif
                        </div>




                        <div class="form-group col-md-6">
                            <label for="montant">Montant</label>

                                <input type="number" min="0" wire:model="montant" class="form-control rounded-0"
                                    id="montant" placeholder="Montant">

                                @error('montant')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror

                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label for="montant">Bordereau N°</label>

                            <input wire:model="bordereau" type="text" class="form-control rounded-0" id="bordereau"
                                placeholder="">

                            @error('bordereau')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror

                        </div> --}}
                            <div class="form-group col-md-6">
                                <label for="">Periode</label>

                                <select wire:model="trimestre" name="" id=""
                                    class="form-control rounded-0">
                                    <option value="">Choisissez ici le trimestre</option>

                                    <option value="PREMIER TRIMESTRE">
                                        PREMIER TRIMESTRE
                                    </option>
                                    <option value="DEUXIEME TRIMESTRE">
                                        DEUXIEME TRIMESTRE
                                    </option>
                                    <option value="TROISIEME TRIMESTRE">
                                        TROISIEME TRIMESTRE
                                    </option>


                                </select>

                                @error('trimestre')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="form-group col-md-6">

                                <label for="">PAIEMENT</label>

                                <select multiple class="form-control rounded-0" wire:model.lazy="type_paiement"
                                    id="">
                                    <option value="">CHOISISSEZ ....</option>
                                    <option value="MINERVAL">MINERVAL</option>
                                    <option value="TRANSPORT">TRANSPORT</option>
                                    <option value="CONTRIBUTION">CONTRIBUTION</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <div class="">
                                    <label for="">ANNE SCOLAIRE</label>
                                    <label for=""> <b>{{ $anneScolaire->name ?? '' }}</b> </label>

                                </div>
                            </div>



                        <div class="col-md-3 mt-3">
                            @if ($eleve and $compteName)
                                <button type="submit" class="btn btn-primary btn-block p-1">💰 Payer</button>
                            @endif
                        </div>
                    </div>





                </form>
            </div>

        @endif
    </div>

    @if ($paiements->count() > 0 && $ordre)

        <div>
            <div class="col-md-4">
                <input type="text" wire:model.live="search" placeholder="Rechercher"
                    class="form-control form-control-sm">
            </div>

        </div>

        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>COMPTE</th>
                    <th>NOM ET PRENOM</th>
                    <th>CLASSE</th>
                    <th>SECTION</th>
                    <th>MONTANT</th>
                    <th>PERIODE</th>
                    <th>BORDEREAU N° </th>
                    <th>MOTIF</th>
                    <th>DATE</th>
                    <th>Action</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($paiements as $paiment)
                    <tr>
                        <td>{{ $paiment->id }}</td>
                        <td>{{ $paiment->compte_name }}</td>
                        <td>{{ $paiment->eleve->fullName }}</td>
                        <td>{{ $paiment->eleve->classe->name }}</td>
                        <td>{{ $paiment->eleve->classe->section->name }}</td>
                        <td>{{ $paiment->amount }}</td>
                        <td>{{ $paiment->trimestre }}</td>
                        <td>{{ $paiment->bordereau }}</td>
                        <td>
                            @php
                                 $type = json_decode($paiment->type_paiement)
                            @endphp
                            @if (!empty($type))

                            @foreach ($type as $key => $typepaiement)
                            {{ $typepaiement}}
                            @endforeach

                            @endif
                        </td>
                        <td>{{ $paiment->created_at }}</td>
                        <td>
                            <button class="btn btn-sm btn-info"
                                wire:click="$emit('printBill',{{ $paiment }})">Imprimer</button>


                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        <div class="d-flex float-right">
            {{ $paiements->links() }}
        </div>
    @endif


{{-- Debut echeance paiement --}}
@if ($echeanceToggle)
<div>
    <div class="container pt-5 border px-5 py-5  border-dark bg-white mt-3">
        <h4 class="text-center">Nouvelle écheance</h4>
        <form wire:submit.prevent="saveEcheance">
            <div class="form-group ">
                <label for="section"> <strong> Section </strong></label>
                <select class="form-control" wire:model="section_id">
                    <option value="">--Selectionner--</option>
                    @foreach ($sections as $section)
                    <option value="{{$section->id}}">{{$section->name}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group ">
                <label for="section"><strong>Nom écheance</strong></label>
                <select class="form-control" wire:model="nom_echeance">
                    <option value="">--Selectionner--</option>
                    <option value="PREMIERE_TRIMESTRE">PREMIERE TRIMESTRE</option>
                    <option value="DEUXIEME_TRIMESTRE">DEUXIEME TRIMESTRE</option>
                    <option value="TROISIEME_TRIMESTRE">TROISIEME TRIMESTRE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="startdate"><strong>Date debut</strong></label>
               <input type="date" class="form-control" wire:model="startDate">
            </div>
            <div class="form-group">
                <label for="endDate"><strong>Date Fin</strong></label>
               <input type="date" class="form-control" wire:model="endDate">
            </div>
            <div class="form-group">
                <label for="amount"><strong>Montant</strong></label>
                <input type="number" class="form-control" wire:model="amount">
            </div>
            <button class="btn btn-sm btn-info">Enregistrer</button>
        </form>

    </div>
</div>
@endif
{{-- Fin echeance paiement --}}



</div>


@push('scripts')
    <script type="text/javascript">
        //montant_lettre.innerHTML = "HELLO JE SUIS UN FUTURE MILLIARDAIRE"
        document.addEventListener('DOMContentLoaded', function() {
            @this.on('printBill', paiement => {
                let number_letter = NumberToLetter(paiement.amount);

                @this.call('printBill', paiement.id, number_letter);

                //printPage('main-content');
            })

        });

        function clickButton() {
            printPage('main-content');
        }
    </script>
@endpush
