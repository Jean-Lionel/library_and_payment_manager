<div>
	{{-- Stop trying to control. --}}
	<div class="row">
		<div class="col-md-4">

			<h4>Ajouter un proffesseur</h4>
			<form action="" wire:submit.prevent="saveProffesseur()">
				<div class="form-group">
					<label for="">Nom et prénom</label>
					<input type="text" class="form-control" wire:model="name" name="">
					@error('name')
					<span class="error text-danger">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="">Téléphone</label>
					<input class="form-control" type="phone" wire:model="telephone" name="">
				</div>

				<div class="form-group">
					<button class="btn btn-info">Enregistrer</button>
				</div>

			</form>

		</div>

		<div class="col-md-8">
			<div class="row">
				<div class="col">
					<h4>Liste des proffesseur</h4>
				</div>
				<div class="col">
					<input type="text" placeholder="Rechercher ici !!" name="" wire:model="search">
				</div>
			</div>

			<table class="table tab-content">
				<thead>
					<tr>
						<th>NUMERO</th>
						<th>NOM ET PRENOM</th>
						<th>TELEPHONE</th>
					</tr>
				</thead>
				<tbody>
					@forelse($proffesseurs as $key => $proffesseur)
					<tr>
						<td>{{ ++$key }}</td>
						<td>{{ $proffesseur->name }}</td>
						<td>{{ $proffesseur->telephone }}</td>
					</tr>

					@empty
					<tr>
						<th colspan="3">Pas de professeur disponible</th>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
</div>
