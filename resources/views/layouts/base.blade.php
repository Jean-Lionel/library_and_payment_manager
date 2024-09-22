<!doctype html>
	<html lang="en">
	<head>
		<title>ECOLE PARENT ELEVE</title>
		<meta charset="utf-8">
		<link rel="icon" type="text/css" href="data:.">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="{{ asset('fonts/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

		<link rel="stylesheet" href="{{ asset('style.css')}}" defer>
		<link rel="stylesheet" href="{{ asset('css/print.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
		@livewireStyles

		<style type="text/css">


			.{
				background: rgba(205,250,200,0.5);
			}
			.active{
				background: rgba(0,0,0,.5);
				border-radius: 6px;
				padding-left: 5px;
				text-indent:6px;
				/* margin-left: 5px; */
				color:black;
			}
		</style>

	</head>
	<body class="container-fluid">

		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4 ">
					<h1><a href="#" class="logo">{{configuration()->etablimssement ?? ""}} </a></h1>
					<ul class="list-unstyled components mb-5 text-light">
                        @can(['is-admin'])
                        <li class="{{ setActiveRoute('accueil') }}">
							<a href="{{ route('accueil') }}"><span class="fa-solid fa-school mr-3 text-light"></span>Accueil</a>
						</li>
                        @endcan
                        @can(['is-admin'])
                        <li class="{{ setActiveRoute('ecoles.create') }}">
							<a href="{{ route('ecoles.create') }}"><span class="fa-solid fa-school mr-3 text-light"></span> Ecoles</a>
						</li>
                        @endcan
						@canany(['is-admin','is-prefet'])
						<li class="{{ setActiveRoute('eleves.index') }}">
							<a href="{{ route('eleves.index') }}"><span class="fas fa-child mr-3 text-light"></span> Eleve</a>
						</li>
						@endcanany

						@canany(['is-admin','is-prefet','is-professeur'])
						<li class="{{ setActiveRoute('cours.index') }}">
							<a href="{{ route('cours.index') }}"><span class="fas fa-book-reader mr-3 text-light"></span> Cours</a>
						</li>
						@endcanany
                        @canany(['is-admin','is-prefet','is-professeur'])
						<li class="{{ setActiveRoute('horaire') }}">
							<a href="{{ route('horaire') }}"><span class="fas fa-stopwatch mr-3 text-light"></span>Horaire</a>
						</li>
						@endcanany
						@canany(['is-admin','is-comptable','is-prefet'])
						<li  class="{{ setActiveRoute('paiements.index') }}">
							<a href="{{ route('paiements.index') }}"><span class="fa fa-briefcase mr-3 text-light"></span> Paiement</a>
						</li>
						@endcanany

						@canany(['is-admin','is-bibliothequaire','is-prefet'])
						<li class="{{ setActiveRoute('bibliotheque') }}">
							<a href="{{ route('bibliotheque') }}"><span class="fa fa-book mr-3 text-light"></span> Bibliothèque</a>
						</li>
						@endcanany

						@canany(['is-admin','is-comptable','is-prefet'])
						<li class="{{ setActiveRoute('patrimoines.index') }}">
							<a href="{{ route('patrimoines.index') }}"><span class="fa fa-sticky-note mr-3 text-light"></span>Patrimoines</a>
						</li>
						@endcanany
						@canany(['is-admin','is-cantine','is-comptable'])
						<li class="{{ setActiveRoute('stoks.index') }}">
							<a href="{{ route('stoks.index') }}"><span class="fa fa-suitcase mr-3 text-light"></span> Stock</a>
						</li>
						@endcanany
						@canany(['is-admin','is-cantine','is-comptable'])
						<li class="{{ setActiveRoute('ventes.index') }}">
							<a href="{{ route('ventes.index') }}"><span class="fa fa-cogs mr-3 text-light"></span> Cantine</a>
						</li>
						@endcanany

						@canany(['is-admin'])
						<li class="{{ setActiveRoute('configurations.index') }}">
							<a href="{{ route('configurations.index') }}"><span class="fa  	fa fa-cog mr-3 text-light"></span> Configuration</a>
						</li>
						@endcanany

						@canany(['is-admin','is-comptable','is-prefet'])
						<li class="{{ setActiveRoute('expenses.index') }}">
							<a href="{{ route('expenses.index') }}"><span class="fas fa-chart-line mr-3 text-light"></span> Depense</a>
						</li>
						@endcanany
						@canany(['is-admin','is-comptable','is-prefet'])
						<li class="{{ setActiveRoute('rapport') }}">
							<a href="{{ route('rapport') }}"><span class="fa fa fa-bar-chart-o mr-3 text-light"></span> Rapport</a>
						</li>
						@endcanany

						@canany(['is-admin','is-prefet'])
                        <li class="{{ setActiveRoute('repetiteur') }}">
							<a href="{{ route('repetiteur') }}"><span class="fa fa fa-users mr-3 text-light"></span>Repetiteur</a>
						</li>
						<li class="{{ setActiveRoute('utilisateur') }}">
							<a href="{{ route('utilisateur') }}"><span class="fa fa fa-users mr-3 text-light"></span> Utilisateur</a>
						</li>
						<li class="{{ setActiveRoute('parents') }}">
							<a href="{{ route('parents') }}"><span class="fas fa-restroom mr-3 text-light"></span> Parents</a>
						</li>
						@endcanany

						<li class="{{ setActiveRoute('profiles') }}">
							<a href="{{ route('profiles') }}"><span class="fas fa-user-circle mr-3 text-light"></span> Profil</a>
						</li>

					</ul>


				</div>
			</nav>

			<!-- Page Content  -->
			<div id="content">
				<div class="row col-12 d-flex flex-row-reverse mt-3">
					<form id="logout-form" action="{{ route('logout') }}" method="POST">
						@csrf

						<button type="submit" class="btn border-success p-1"><span class="fa fa-lock mr-2 text text-success"></span>Deconnexion</button>
					</form>

					<div class="mr-3 d-flex align-items-center">
						<h6 class="text text-success"> <i class="fa fa-user "></i> {{ Auth::user()->name}}</h6>
					</div>
				</div>
				@if(session()->has('success'))
				<div class="alert alert-success">
					{{ session()->get('success') }}
				</div>
				@endif

				@if(session()->has('error'))
				<div class="alert alert-danger">
					{{ session()->get('error') }}
				</div>
				@endif

				<div  class="p-md-2 ml-4">
					@yield('content')
				</div>
			</div>
		</div>

		<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
		<script src="{{ asset('js/popper.js') }}"></script>
		<script src="{{ asset('js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('js/print.min.js') }}"></script>
		<script src="{{ asset('js/main.js') }}"></script>
		<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
		<script src="{{ asset('js/Chart.bundle.min.js') }}"></script>
		<script src="{{ asset('js/convertToLetter.js') }}"></script>

		<script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('datatable/datatables.min.js') }}"></script>
		<script src="{{ asset('datatable/pdfmake.min.js') }}"></script>


		@livewireScripts
		@yield('javascript')
		@stack('scripts')

	</body>
	</html>
