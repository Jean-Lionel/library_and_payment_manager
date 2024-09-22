<div>
	{{-- The whole world belongs to you --}}

	   @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
    @endif

     @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
    @endif

    <style>
        .btn
        {
            background: #1A5684;
            color: #ffffff;
        }
    </style>

	<div class="row">

		<div class="col-md-4">
			<h3 class="text-center">Retrait du livre</h3>
			{{-- <form action="" wire:submit.prevent="validerEmprut()"> --}}

				<div class="form-group">
					<label for="">TYPE DE LECTEUR</label>
					<select wire:model="type_lecteur" class="form-control form-control-sm">
						<option value="eleves">ELEVE</option>
						<option value="professeurs">PROFESSEUR</option>
						<option value="lecteurs">PARTICULIER</option>
					</select>
				</div>
				<div class="form-group ">
					<label for=""> INDENTIFIANT</label>
					<div class="row container">
						<input type="text" wire:model="searchKey" class="form-control form-control-sm col-md-12" placeholder="Rechercher ici !!!!">
						<!-- <button class=" btn-info btn-sm ml-2 col-md-2" wire:click="searchReader">Ok</button> -->
					</div>

						@forelse($readers as $reader)
					{{-- 	{{ $reader }} --}}
						<div class="row p-2" >

							<div class="col">
								<h6>Nom et Prénom</h6>
								<h6>{{  $reader->first_name.' '.$reader->last_name  }}</h6>
							</div>
							<div class="col">
								<h6>SECTION : {{ $reader->classe->section->name  }}</h6>
								<h6> CLASSE : {{ $reader->classe->name  }}</h6>

							</div>
							<div class="col-12">
								<button wire:click="choisirEleve({{$reader  }})" class="btn btn-block btn-outline-success btn-sm">Choisir</button>
							</div>
						</div>
						@empty
						<p>Rechercher</p>
						@endforelse

				</div>


			{{-- </form> --}}

			<div>
				<ul class="list-group">
					<li class="text-center"><h6 class="text-info">Liste des livres choisit</h6></li>
				@forelse( Cart::content() as $selectBook)
				<li class="list-group-item d-flex justify-content-between">

					<span>{{ $selectBook->name }}</span>
					<span>Nombre de livre :  <b>{{ $selectBook->qty }}</b></span>
					<span>
						 <button wire:click="removeItem('{{ $selectBook->rowId }}')" class="btn-danger btn-sm">-</button>
					</span>
				</li>
				@empty

				@endforelse
				</ul>

				<input type="number" min="0" max="60" wire:model="nbre_jour">
				@error('nbre_jour')
				<span class="error text-danger"> {{ $message }}</span>

				@enderror
				<button wire:click="validerRetrait()" class="btn btn-sm rounded-0 mt-2">Valider le retrait</button>
			</div>
		</div>

		<div class="col-md-4">
			@if($empreteur)
				<div class="card">
					<h6> NOM ET PRENOM : {{  $empreteur->first_name.' '.$empreteur->last_name  }}</h6>
					<h6>SECTION : {{  $empreteur->classe->section->name  }}</h6>
					<h6> CLASSE : {{  $empreteur->classe->name  }}</h6>
					<button wire:click="closeSearch" class="btn-danger btn-block btn-sm">X</button>
				</div>
			@endif

			<div>
				<h5>Rechercher le livre</h5>

				<div class="row">
					<div class="form-group col-12">
						<input type="text" class="form-control form-control-sm" wire:model="book_title">
					</div>

					@forelse($livres as $livre)
					 <div class="card col-12">
					 	<div class="card-title text-center">
					 		Titre: {{ $livre->title }}
					 	</div>
					 	<div class="card-body">
					 		<div class="d-flex justify-content-between">
					 			<button wire:click="afficherLivre({{ $livre->id }})" class=" btn-sm" title="plus d'info"> <i class="fa fa-info-circle" aria-hidden="true"></i></button>
					 			<span>Auteur : {{  $livre->author->name  }}</span>
					 			<button class="btn-sm btn-primary" wire:click="ajouterAuPanier({{ $livre->id }})">+</button>
					 		</div>
					 	</div>
					 </div>

					 <hr>

					@empty

					@endforelse
				</div>


			</div>

		</div>

		<div class="col-md-4">

			@if($choosedBook)
			        <h4 class="text-center">Détail du livre </h4>

					<ul  class="bg-info list-group" >
						<li class="list-group-item"> Titre : {{ $choosedBook->title }}</li>
						<li class="list-group-item" > Auteur : {{ $choosedBook->author->name }}</li>
						<li class="list-group-item" > Edition : {{ $choosedBook->edition }}</li>
						<li class="list-group-item"> ISBN : {{ $choosedBook->isbn }}</li>
						<li class="list-group-item"> CLASSEMENT : {{ $choosedBook->classement->name }}</li>
						<li class="list-group-item"> Nombre d'exemplaire disponibre : {{ $choosedBook->nombre_exemplaire - $choosedBook->nombre_livre_retire }}</li>

						<li class="list-group-item">ETAGEGERE :  {{ $choosedBook->classement->etager->name }}</li>

					</ul>

			@endif

		</div>

		{{-- <div class="col-md-5">
			<div class="row">
				<div class="col">
					<h6>Liste des livres</h6>
				</div>
				<div class="col">
					<div class="form-group">
						<label for="">CATEGORIE</label>

						<select wire:model="category" class="form-control">
							<option value="">Choisissez la categorie</option>

							@foreach($categories as $cat)
								<option value="{{ $cat->id }}">{{ $cat->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			@forelse($livres as $key => $book)
			<div class="row">

				<div class="col-2">
					<h4>Je suis</h4>
				</div>
			</div>

			<hr>

			@empty


			@endforelse
		</div> --}}
	</div>

</div>
