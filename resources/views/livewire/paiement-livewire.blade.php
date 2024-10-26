<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <style>
        .btn {
            background: #1A5684 !important;
            color: #ffffff;
            border: none
        }
    </style>
    <div class="row mb-3">
        <div class="col-md-12 d-flex justify-content-center align-items-center mt-4">
            <div class="col-md-4">
                <a href="{{ route('paiements.create') }}" class="btn btn-lg">Rapport des paimements </a>
            </div>
            <div class="col-md-4">
                <button wire:click="showForm" class="btn btn-primary btn-lg"> Nouveau Paiement</button>
            </div>

            <div class="col-md-4">
                <button wire:click="showEnOrdre" class="btn btn-primary btn-lg"> Historique de paiements</button>
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
                <form wire:submit.prevent="savePaiement">
                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="compte_name">COMPTE</label>
                            <input class="form-control form-controlborder-dark" type="text" wire:model="compteName">
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
                            <div class="col-sm-8">
                                <input type="number" min="0" wire:model="montant"
                                    class=" border-dark form-control" id="montant" placeholder="Montant">

                                @error('montant')
                                    <span class="error text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>




                        <div class="form-group col-md-6">
                            <label for="montant">Bordereau N°</label>

                            <input wire:model="bordereau" type="text" class="form-control border-dark" id="bordereau"
                                placeholder="">

                            @error('bordereau')
                                <span class="error text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label" for="">Periode</label>

                                    <select wire:model="trimestre" name="" id=""
                                        class="form-control col-sm-8 border-dark">
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
                            </div>

                            <div class="col-md-4">
                                <div class="form-group row">

                                    <label for="" class="col-sm-6">PAIEMENT</label>

                                    <select multiple class="col-md-6 form-control border-dark" wire:model.lazy="type_paiement"
                                        id="">
                                        <option value="">CHOISISSEZ ....</option>
                                        <option value="MINERVAL">MINERVAL</option>
                                        <option value="TRANSPORT">TRANSPORT</option>
                                        <option value="CONTRIBUTION">CONTRIBUTION</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-between">
                                    <label for="">ANNE SCOLAIRE</label>
                                    <label for=""> <b>{{ $anneScolaire->name ?? '' }}</b> </label>

                                </div>
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
                <input type="text" wire:model.live="search" placeholder="Rechercher" class="form-control form-control-sm">
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
                        <td>{{ $paiment->type_paiement }}</td>
                        <td>{{ $paiment->created_at }}</td>
                        <td>
                            <button class="btn btn-sm btn-info"
                                wire:click="$emit('printBill',{{ $paiment }})">Imprimer</button>


                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    @endif
    <div>
        {{ $paiements->links() }}
    </div>


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
