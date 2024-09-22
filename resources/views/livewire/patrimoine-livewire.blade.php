<div>
	{{-- The whole world belongs to you --}}

	{{-- public string $name;
	public string $description;
	public float $quantite_total;
	public float $qte_en_mauvaise_etat;
	public float $quantite_en_bonne_etat; --}}
    <style>
        .btn
        {
            background: #1A5684;
            color: #ffffff;
        }
    </style>

	@if($open)
	<div>
		<h4 class="text-center">Enregistrement des Patrimoines</h4>
		<button wire:click="$set('open',false)">Fermer <i class="fa fa-close"> </i></button>
	<form wire:submit.prevent="savePatrimoine">
		<div class="form-row">

			<div class="form-group col-md-4">
				<label for="">DESIGNATION</label>
				<input type="text" wire:model="name" class="form-control rounded-0">
				@error('name')
				<span class="error text-danger">{{ $message }}</span>
				@enderror
			</div>

			<div class="form-group col-md-4">
				<label for="">description</label>
				<textarea class="form-control rounded-0" wire:model="description"></textarea>
				@error('description')
				<span class="error text-danger">{{ $message }}</span>
				@enderror
			</div>



			<div class="form-group col-md-4">
				<label for="">QUANTITE TOTAL</label>
				<input type="number" min="0" wire:model="quantite_total" class="form-control rounded-0">
				@error('quantite_total')
				<span class="error text-danger">{{ $message }}</span>
				@enderror
			</div>

			<div class="form-group col-md-4">
				<label for="">QTE EN BON ETAT</label>
				<input type="number" wire:model="qte_en_mauvaise_etat" class="form-control rounded-0">
				@error('qte_en_mauvaise_etat')
				<span class="error text-danger">{{ $message }}</span>
				@enderror
			</div>

			<div class="form-group col-md-4">
				<label for="">QTE EN MAUVAIS ETAT</label>
				<input type="number" wire:model="quantite_en_bonne_etat" class="form-control rounded-0">
				@error('quantite_en_bonne_etat')
				<span class="error text-danger">{{ $message }}</span>
				@enderror
			</div>


        </div>
        @if ($identifiant !== null)
				{{-- expr --}}
				<button type="submit" class="btn btn-warning float-right">MODIFIER</button>
			@else
			<button type="submit" class="btn btn-sm rounded-0 float-right">ENREGISTRER</button>

			@endif
	</form>
	</div>

	@else
	<div class="col-md-12">
		<h1 class="text-center">Liste des biens</h1>
		<div class="text-right">
			<input type="text" placeholder="Rechercher" name="">
			<button wire:click="$set('open', true)">Ajouter</button>
		</div>
		<table class="table table-bordered table-sm">
			<thead>
				<tr>
					<th>#</th>
					<th>DESIGNATION</th>
					<th>DESCRIPTION</th>
					<th>Qté TOTAL</th>
					<th>Qté EN BONNE ETAT</th>
					<th>Qté EN MAUVAISE ETAT</th>
					<th>ACTION</th>
				</tr>

			</thead>
			<tbody>

				@foreach($patrimoines as $patrimoine)
				<tr>
					<td>{{ $patrimoine->id }}</td>
					<td>{{ $patrimoine->name }}</td>
					<td>{{ $patrimoine->description }}</td>
					<td>{{ $patrimoine->quantite_total }}</td>
					<td>{{ $patrimoine->quantite_en_bonne_etat }}</td>
					<td>{{ $patrimoine->qte_en_mauvaise_etat }}</td>

					<td>
						<button wire:click="edit({{ $patrimoine->id  }})">Modifier</button>
						<button class="btn btn-sm btn-danger" wire:click="$emit('deletePatrimoine',{{ $patrimoine->id  }})">Supprimer</button>
					</td>

				</tr>

				@endforeach

			</tbody>
		</table>
	</div>

	@endif


</div>

@push('scripts')
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded',function(){
		@this.on('deletePatrimoine',(el )=>{
			const response = confirm("êtez-vous sûr de vouloir de supprimer ?");

			if(response){
				@this.call('effacer',el)
			}
		})
	});

</script>
@endpush



