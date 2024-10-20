<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    {{-- <link rel="stylesheet" href="{{ asset('impression.css') }}" defer> --}}
    <style>
        .btn {
            background: #1A5684 !important;
            color: #ffffff;
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

        @canany(['is-admin', 'is-prefet'])
            @if ($selectedClasse)
                <div class="col-md-3">
                    <a class="btn-primary btn btn-block"
                        href="{{ route('eleves.create', ['id' => $selectedClasse]) }}">Nouveau</a>
                </div>
            @endif
        @endcanany

        @canany(['is-admin', 'is-professeur'])
            <div class="col-md-3">
                <a class="btn-primary btn btn-block" href="#">Mes eleves</a>
            </div>
        @endcanany
        @canany(['is-admin', 'is-professeur'])
            <div class="col-md-3">
                <a class="btn-primary btn btn-block" href="#"><i class="i
                fa fa-print"></i></a>
            </div>
        @endcanany
    </div>

    <div class="tabledata mt-3 card--container">
        <form method="POST" action="{{ route('presences.store') }}">
            @csrf
            <table class="table table-bordered table-sm ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        {{-- <th>Section</th>
                <th>Classe</th> --}}
                        <th>Numéro de compte</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Sexe</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eleves as $key => $eleve)
                        <tr>
                            <td>
                            
                            @if (!$eleve->isPresentToday())
                            <input type="checkbox" value="{{ $eleve->id }}" name="eleve_id[]" />
                            @endif
                                
                            </td>
                            {{-- <td>{{ ++$key }}</td> --}}
                            <td><img src="{{ asset('uploads/eleve/' . $eleve->image_eleve) }}" alt="image"
                                    style="width: 44px; height: 44px; border-radius: 100%;" /></td>
                            {{-- <td>{{ $eleve->classe->section->name }}</td>
              <td>{{ $eleve->classe->name }}</td> --}}
                            <td>{{ $eleve->compte->name ?? '' }}</td>
                            <td>{{ $eleve->first_name }}</td>
                            <td>{{ $eleve->last_name }}</td>
                            <td>{{ $eleve->sexe }}</td>
                            <td>{{ $eleve->address }}</td>
                            <td class="d-flex ">
                                <a href="{{ route('eleves.edit', $eleve) }}" class="btn-sm btn-info mr-2">Modifier</a>
                                <button class="bg-primary">
                                    <i class="fa fa-pencil text-white"></i>
                                </button>

                                {{-- <form action="{{ route('eleves.destroy', $eleve) }}" method="POST">
                  @csrf
                  @method('DELETE')

                  <button class="btn-sm btn-danger" onclick="return confirm('Etez-vous sûr ?')">Supprimer</button>
                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button class=" btn btn-sm  float-right">Enregistrer</button>
        </form>
        {{ $eleves->links() }}
    </div>
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
                        <a data-mdb-ripple-init class="btn btn-light text-capitalize border-0"
                            data-mdb-ripple-color="dark"><i class="fas fa-print text-white"></i> Print</a>
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
                                    <th scope="col">Nom et Prenom</th>
                                    <th scope="col">Postnom</th>
                                    <th scope="col">Sexe</th>
                                    <th scope="col">Classe</th>
                                    <th scope="col">Option</th>
                                    <th scope="col">Date de naissance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eleves as $key => $eleve)
                                <tr>
                                    <td>{{ $eleve->compte->name ?? '' }}</td>
                                    <td>{{ $eleve->first_name }}</td>
                                    <td>{{ $eleve->last_name }}</td>
                                    <td>{{ $eleve->sexe }}</td>
                                    <td>{{ $eleve->address }}</td>
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

    {{-- invoice deux --}}
    <!-- Invoice 1 - Bootstrap Brain Component -->
    {{-- <section class="py-3 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
                    <div class="row gy-3 mb-3">
                        <div class="col-6">
                            <h2 class="text-uppercase text-endx m-0">Invoice</h2>
                        </div>
                        <div class="col-6">
                            <a class="d-block text-end" href="#!">
                                <img src="./assets/img/bsb-logo.svg" class="img-fluid" alt="BootstrapBrain Logo"
                                    width="135" height="44">
                            </a>
                        </div>
                        <div class="col-12">
                            <h4>From</h4>
                            <address>
                                <strong>BootstrapBrain</strong><br>
                                875 N Coast Hwybr<br>
                                Laguna Beach, California, 92651<br>
                                United States<br>
                                Phone: (949) 494-7695<br>
                                Email: email@domain.com
                            </address>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-sm-6 col-md-8">
                            <h4>Bill To</h4>
                            <address>
                                <strong>Mason Carter</strong><br>
                                7657 NW Prairie View Rd<br>
                                Kansas City, Mississippi, 64151<br>
                                United States<br>
                                Phone: (816) 741-5790<br>
                                Email: email@client.com
                            </address>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4">
                            <h4 class="row">
                                <span class="col-6">Invoice #</span>
                                <span class="col-6 text-sm-end">INT-001</span>
                            </h4>
                            <div class="row">
                                <span class="col-6">Account</span>
                                <span class="col-6 text-sm-end">786-54984</span>
                                <span class="col-6">Order ID</span>
                                <span class="col-6 text-sm-end">#9742</span>
                                <span class="col-6">Invoice Date</span>
                                <span class="col-6 text-sm-end">12/10/2025</span>
                                <span class="col-6">Due Date</span>
                                <span class="col-6 text-sm-end">18/12/2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-uppercase">Qty</th>
                                            <th scope="col" class="text-uppercase">Product</th>
                                            <th scope="col" class="text-uppercase text-end">Unit Price</th>
                                            <th scope="col" class="text-uppercase text-end">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-group-divider">
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Console - Bootstrap Admin Template</td>
                                            <td class="text-end">75</td>
                                            <td class="text-end">150</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Planet - Bootstrap Blog Template</td>
                                            <td class="text-end">29</td>
                                            <td class="text-end">29</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Hello - Bootstrap Business Template</td>
                                            <td class="text-end">32</td>
                                            <td class="text-end">128</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Palette - Bootstrap Startup Template</td>
                                            <td class="text-end">55</td>
                                            <td class="text-end">55</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">Subtotal</td>
                                            <td class="text-end">362</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">VAT (5%)</td>
                                            <td class="text-end">18.1</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-end">Shipping</td>
                                            <td class="text-end">15</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" colspan="3" class="text-uppercase text-end">Total
                                            </th>
                                            <td class="text-end">$495.1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary mb-3">Download Invoice</button>
                            <button type="submit" class="btn btn-danger mb-3">Submit Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    {{-- fin invoice deux --}}


</div>
