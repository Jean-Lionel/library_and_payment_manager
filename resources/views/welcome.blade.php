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
    <div class="card--container">
        <h3 class="main--title">Today's Data</h3>
        <div class="card--wrapper">
                <div class="payment--card light-red col-md-3">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Nombre ecole
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
                                Nombre eleve
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
                       Nouvelle
                    </span>
                </div>
        </div>

    </div>
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
            {{ $ecoles->links()}}
        </div>
    </div>

</div>
    {{-- fin test --}}

</div>


@stop

@section('scripts')
<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
    })
</script>

@stop
