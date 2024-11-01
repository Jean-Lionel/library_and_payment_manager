<div>
	{{-- Stop trying to control. --}}
	<div class="row">
		<div class="col-md-12">
			<div>

				@if (session()->has('message'))

				<div class="alert alert-success">

					{{ session('message') }}
				</div>

				@endif

			</div>
		</div>


		@if ($showForm)
		{{-- expr --}}
		<div class="container pt-5 border px-5 py-5  border-dark bg-white">

			<h4 class="text-center text-uppercase">Ajouter un proffesseur</h4>
			<form action="" wire:submit.prevent="saveProffesseur()">
				<div class="form-group">
					<label for="">Nom et prénom</label>
					<input type="text" class="form-control rounded-0" wire:model="name" name="">
					@error('name')
					<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="">Téléphone</label>
					<input class="form-control rounded-0" type="text" wire:model="telephone" name="">
					@error('telephone')
					<span class="error text-danger">{{ $message }}</span>
					@enderror

				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input class="form-control rounded-0" type="email" wire:model="email" name="">
					@error('email')
					<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label for="">Mot de passe </label>
					<input class="form-control rounded-0" type="password" wire:model="password" name="">
					@error('password')
					<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<button class="btn btn-info w-100">Enregistrer</button>
				</div>

			</form>

		</div>
		@else

		<div class="col-md-12">
			<div class="row">
				<div class="col-md-6">
					<h4>Liste des proffesseur</h4>
				</div>
				<div class="col-md-4">
					<input type="text" placeholder="Rechercher ici !!" name="" wire:model="search" class="form-control">
				</div>
				<div class="col-md-2">
					<button wire:click="$set('showForm', true)" class="btn btn-primary" title="Ajouter un professeur">
						<i class="fa fa-plus"></i>
					</button>
				</div>
			</div>

			<table class="table tab-content table-sm table-hover">
				<thead>
					<tr>
						<th>NUMERO</th>
						<th>NOM ET PRENOM</th>
						<th>EMAIL</th>
						<th>TELEPHONE</th>
						<th>UTILISATEUR N°</th>
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					@forelse($proffesseurs as $key => $proffesseur)
					<tr>
						<td>{{ ++$key }}</td>
						<td>{{ $proffesseur->name }}</td>
						<td>{{ $proffesseur->email }}</td>
						<td>{{ $proffesseur->telephone }}</td>
						<td>{{ $proffesseur->user_id?? 'Pas de numéro'  }}</td>
						<td>
							<button class="btn-info" wire:click="updateProfesseur({{$proffesseur->id}})">Modifier</button>

							@if ($proffesseur->user_id == null)
							{{-- expr --}}
							<button class="btn-info" wire:click="setAsUser({{$proffesseur->id}})" title="définir comme un utilisateur">Utilisateur</button>
							@endif
						</td>
					</tr>

					@empty
					<tr>
						<th colspan="3">Pas de professeur disponible</th>
					</tr>
					@endforelse
				</tbody>
			</table>

			{{ $proffesseurs->links() }}
		</div>

		@endif
	</div>
</div>
