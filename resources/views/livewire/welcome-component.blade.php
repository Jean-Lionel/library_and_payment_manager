@extends('layouts.base')

@section('content')
<div>




    {{-- <div class="row"> --}}
    <!-- 	<div class="col-md-6">
   <img src="{{ asset('images/login/undraw_book_lover_mkck.svg') }}" alt="" class="img-fluid">
  </div>
  <div class="col-md-6 d-flex">
   <img src="{{ asset('images/cloe-ferrara-loader1-0.gif') }}" class="img-thumbnail" alt="">

  </div> -->

    {{-- </div> --}}

    <div>
        <h3 class="text-center text-primary"> ACCOMPAGNE VOS ENFANTS DANS EDUCATION.</h3>
    </div>


    {{-- Test menu --}}

    <div class="container-fluid newcard">
        @can(['is-admin'])
            <div class="card--container">
                <h3 class="main--title">Tableau de Bord</h3>
                <div class="card--wrapper">
                    <div class="payment--card light-red col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre ecole
                                </span>
                                <span class="amount-value">
                                    {{$count_ecole}}
                                </span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-purple col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre eleve
                                </span>
                                <span class="amount-value">
                                    {{$count_eleve}}
                                </span>
                            </div>
                            <i class="fas fa-list icon dark-purple"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-purple col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre Parents
                                </span>
                                <span class="amount-value">
                                    15000
                                </span>
                            </div>
                            <i class="fas fa-list icon dark-purple"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>
                    <div class="payment--card light-purple col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre Répetiteur
                                </span>
                                <span class="amount-value">
                                    {{$count_repetiteur}}
                                </span>
                            </div>
                            <i class="fas fa-list icon dark-purple"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-green col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre enseignants
                                </span>
                                <span class="amount-value">
                                    $5000.00
                                </span>
                            </div>
                            <i class="fas fa-users icon dark-green"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>
                    <div class="payment--card light-green col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Outils de travail
                                </span>
                                <span class="amount-value">
                                    5000
                                </span>
                            </div>
                            <i class="fas fa-users icon dark-green"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-blue col-md-2">
                        <span class="icons-plus">
                            <i class="fas fa-plus dark-blue plus-icon"></i>
                        </span>
                        <span class="plus">
                            Nouvelle
                        </span>
                    </div>
                </div>

            </div>
        @endcan
        @can(['is-prefet'])
        <div class="card--container">
            <h3 class="main--title">Tableau de Bord</h3>
            <div class="card--wrapper">

                <div class="payment--card light-purple col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre eleve
                            </span>
                            <span class="amount-value">
                                {{$eleve_by_ecole}}
                            </span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>

                <div class="payment--card light-purple col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre Parents
                            </span>
                            <span class="amount-value">
                                15000
                            </span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>
                <div class="payment--card light-purple col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre Répetiteur
                            </span>
                            <span class="amount-value">
                                {{$repetiteur_by_ecole}}
                            </span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>

                <div class="payment--card light-purple col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre Section
                            </span>
                            <span class="amount-value">
                                {{$count_eleve}}
                            </span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>

                <div class="payment--card light-purple col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre Classe
                            </span>
                            <span class="amount-value">
                                {{$classe_by_ecole}}
                            </span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>
                <div class="payment--card light-purple col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre Livre
                            </span>
                            <span class="amount-value">
                                {{$count_repetiteur}}
                            </span>
                        </div>
                        <i class="fas fa-list icon dark-purple"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>

                <div class="payment--card light-blue col-md-2">
                    <span class="icons-plus">
                        <i class="fas fa-plus dark-blue plus-icon"></i>
                    </span>
                    <span class="plus">
                        Abandonts
                    </span>
                </div>

                <div class="payment--card light-green col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre enseignants
                            </span>
                            <span class="amount-value">
                                $5000.00
                            </span>
                        </div>
                        <i class="fas fa-users icon dark-green"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>
                <div class="payment--card light-green col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Montant paiement
                            </span>
                            <span class="amount-value">
                                5000
                            </span>
                        </div>
                        <i class="fas fa-users icon dark-green"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>
                <div class="payment--card light-green col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Montant Depense
                            </span>
                            <span class="amount-value">
                                5000
                            </span>
                        </div>
                        <i class="fas fa-users icon dark-green"></i>
                    </div>
                    <span class="card-detail">
                        *** *** *** 35000
                    </span>
                </div>

                <div class="payment--card light-blue col-md-2">
                    <span class="icons-plus">
                        <i class="fas fa-plus dark-blue plus-icon"></i>
                    </span>
                    <span class="plus">
                        Nouvelle
                    </span>
                </div>
            </div>

        </div>
    @endcan
        @can(['is-admin'])
            {{-- container for prefet --}}
            <div class="card--container mt-5">
                <h3 class="main--title">Today's Data</h3>
                <div class="card--wrapper">
                    <div class="payment--card light-red col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre eleves
                                </span>
                                <span class="amount-value">
                                    $5000.00
                                </span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-purple col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre classe
                                </span>
                                <span class="amount-value">
                                    $5000.00
                                </span>
                            </div>
                            <i class="fas fa-list icon dark-purple"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-green col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Nombre professeur
                                </span>
                                <span class="amount-value">
                                    $5000.00
                                </span>
                            </div>
                            <i class="fas fa-users icon dark-green"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-blue col-md-2">
                        <span class="icons-plus">
                            <i class="fas fa-plus dark-blue plus-icon"></i>
                        </span>
                        <span class="plus">
                            Nouvelle
                        </span>
                    </div>
                </div>

            </div>
        @endcan
        {{-- container for parent --}}
        @can(['is-professeur'])
            <div class="card--container mt-5">
                <h3 class="main--title">Today's Data</h3>
                <div class="card--wrapper">
                    <div class="payment--card light-red col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Mes cours
                                </span>
                                <span class="amount-value">
                                    5
                                </span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-purple col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Mes eleves
                                </span>
                                <span class="amount-value">
                                    5000
                                </span>
                            </div>
                            <i class="fas fa-list icon dark-purple"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-green col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Utilisateurs
                                </span>
                                <span class="amount-value">
                                    $5000.00
                                </span>
                            </div>
                            <i class="fas fa-users icon dark-green"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-blue col-md-2">
                        <span class="icons-plus">
                            <i class="fas fa-plus dark-blue plus-icon"></i>
                        </span>
                        <span class="plus">
                            Mes classes
                        </span>
                    </div>
                </div>

            </div>
        @endcan
        @can(['is-dd'])
            {{-- container for DD --}}
            <div class="card--container mt-5">
                <h3 class="main--title">Tableau de Bord</h3>
                <div class="card--wrapper">
                    <div class="payment--card light-red col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Absence du jour
                                </span>
                                <span class="amount-value">
                                    5000.00
                                </span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-purple col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Retard du Jour
                                </span>
                                <span class="amount-value">
                                    5000.00
                                </span>
                            </div>
                            <i class="fas fa-list icon dark-purple"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-green col-md-3">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">
                                    Trichérie
                                </span>
                                <span class="amount-value">
                                    500
                                </span>
                            </div>
                            <i class="fas fa-users icon dark-green"></i>
                        </div>
                        <span class="card-detail">
                            *** *** *** 35000
                        </span>
                    </div>

                    <div class="payment--card light-blue col-md-2">
                        <span class="icons-plus">
                            <i class="fas fa-plus dark-blue plus-icon"></i>
                        </span>
                        <span class="plus">
                            Exclusion de l'année
                        </span>
                    </div>
                </div>

            </div>
        @endcan
        @can(['is-prefet'])
            {{-- fin container for professeur --}}
            <div class="tabledata mt-3 card--container">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Categorie</th>
                            <th>Type</th>
                            <th>Date creation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ecoles as $key => $ecole)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $ecole->nom_ecole }}</td>
                                <td>{{ $ecole->adresse_ecole }}</td>
                                <td>{{ $ecole->categorie_ecole }}</td>
                                <td>{{ $ecole->type_ecole }}</td>
                                <td>{{ $ecole->date_creation }}</td>
                                <td><button class="btn btn-sm btn-info">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-md-12 d-flex" style="overflow: hidden;">
                    {{-- {{ $ecoles->links() }} --}}
                </div>
            </div>
        @endcan
        {{-- fin container for prefet --}}
        @can(['is-admin'])
            <div class="tabledata mt-3 card--container">
                <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Categorie</th>
                            <th>Type</th>
                            <th>Date creation</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ecoles as $key => $ecole)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $ecole->nom_ecole }}</td>
                                <td>{{ $ecole->adresse_ecole }}</td>
                                <td>{{ $ecole->categorie_ecole }}</td>
                                <td>{{ $ecole->type_ecole }}</td>
                                <td>{{ $ecole->date_creation }}</td>
                                <td><button class="btn btn-sm btn-info">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex float-right" style="overflow: hidden;">
                    {{ $ecoles->links() }}
                </div>
            </div>
        @endcan

    </div>
    {{-- fin test --}}
    @stop
    @section('scripts')
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            })
        </script>

    @stop

</div>
