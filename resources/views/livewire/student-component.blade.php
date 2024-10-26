<div>
     {{-- debut ivoice 1 --}}
     <div class="card mt-2">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;"><strong>REPUBLIQUE DEMOCRATIQUE DU CONGO</strong></p>
                        <p style="color: #7e8d9f;font-size: 20px;"><strong>MINISTERE DE D'EDUCATION PRIMAIRE ET
                                SECONDAIRE</strong></p>
                    </div>
                    <div class="col-xl-3 float-end">
                        <button data-mdb-ripple-init class="btn btn-light text-capitalize border-0"
                            data-mdb-ripple-color="dark" wire:click='generatePdf'><i class="fas fa-print text-white"></i> Print</button>
                        <a data-mdb-ripple-init class="btn btn-light  text-capitalize" data-mdb-ripple-color="dark"><i
                                class="far fa-file-pdf text-success"></i> Export</a>
                    </div>
                    <hr>
                </div>
                <hr style="border: #1A5684 1px solid">
                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            {{-- <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i> --}}
                            <p class="pt-0">INSTITUT ZAWADI</p>
                            <p class="mt-2">LISTE DES ELEVES INSCRITS</p>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">Adresse: <span style="color:#5d9fc5 ;">John Lorem</span></li>
                                <li class="text-muted">Street, City</li>
                                <li class="text-muted">State, Country</li>
                                <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li>
                                <li>Arrété ministeriel: <span>45GYHH6ZR</span></li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">Catégorie:</span>Coventionée Catholique</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="fw-bold">Creation Date: </span>Jun 23,2021</li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                        class="me-1 fw-bold">Status:</span><span
                                        class="badge bg-warning text-black fw-bold">
                                        Unpaid</span></li>
                            </ul>
                        </div>
                    </div>
                    <hr style="border: #1A5684 1px solid">
                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">N° Compte</th>
                                    <th scope="col">Nom et Prenom</th>
                                    <th scope="col">Postnom</th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">Adresse</th>
                                    <th scope="col">Classe</th>
                                    <th scope="col">Section</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $eleve)
                                <tr>
                                    <td>{{$loop->index++}}</td>
                                    <td>{{ $eleve->compte->name ?? '' }}</td>
                                    <td>{{ $eleve->first_name }}</td>
                                    <td>{{ $eleve->last_name }}</td>
                                    <td>{{ $eleve->sexe }}</td>
                                    <td>{{ $eleve->address }}</td>
                                    <td>{{ $eleve->classe->name }}</td>
                                    <td>{{$eleve->classe->section->name}}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xl-8">
                            <p class="ms-3">Add additional notes and payment information</p>

                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">Signature du chef
                                        d'établissement</span></li>
                            </ul>
                        </div>
                    </div>
                    <hr>


                </div>
            </div>
        </div>
    </div>
    {{-- fin ivoice --}}
</div>
