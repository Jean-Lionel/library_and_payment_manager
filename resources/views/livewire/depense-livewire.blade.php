<div>
	{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}


	<div class="btn-group" role="group" aria-label="Basic example">
		<button type="button" wire:click="$set('ShowForm', true)" class="btn btn-secondary" >Nouveau dépense</button>
		<button type="button" class="btn btn-secondary" wire:click="$set('ShowForm', false)">Tout les dépenses</button>
		
	</div>



	@if($ShowForm)
	<form wire:submit.prevent="saveDepense" >
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="" class="col-sm-4">ACTION</label>

					<div class="col-sm-8">

						<input type="text" class="form-control"  wire:model="action">

						@error('action')
						<span class="error text-danger">{{ $message }}</span>
						@enderror

					</div>

				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group row">
					<label for="" class="col-sm-4">MONTANT</label>

					<div class="col-sm-8">
						<input type="number" class="form-control"  wire:model="montant">
						@error('montant')
						<span class="error text-danger">{{ $message }}</span>
						@enderror

					</div>

				</div>
			</div>


			<div class="col-sm-12">
				<div class="form-group row">
					<label class="col-md-2" for="">DESCRIPTION</label>

					<div class="col-sm-10">
						<textarea name="" id="" wire:model="description" class="form-control"></textarea>

						@error('description')
						<span class="error text-danger">{{ $message }}</span>
						@enderror
					</div>

				</div>
				<button type="submit" class="btn btn-primary offset-8 col-md-4">Enregistrer</button>
			</div>

		</div>
	</form>

	@endif

	@if(!$ShowForm)
	<div class="row">
		
		<div class="row col-md-12">
			<h4 class="col-md-1">Liste</h4>
			<div class="col-md-6">
				Du <input type="date" wire:model="debut">
				Aux <input type="date" wire:model="fin">
			</div>
			<div class="col-md-3">
				
				<span>TOTAL :{{ $depenses->sum('montant') }} # FBU</span>
			</div>
			<input class="col-md-2" class="form-control" type="text" wire:model="keyWord" placeholder="Recherchez ici ...">
		</div>


		<table class="table-sm table">
			<thead>
				<tr>
					<td>Numéro</td>
					<td>Action</td>
					<td>Montant</td>
					<td>Date</td>
					{{-- <td>ACTION</td> --}}
				</tr>
			</thead>

			<tbody>
				@foreach($depenses as $key => $depense)

				<tr>
					<td>{{ ++$key }}</td>
					<td>{{ $depense->action}}</td>
					<td>{{ $depense->montant }}</td>
					<td>{{ $depense->created_at }}</td>
				</tr>

				@endforeach
			</tbody>
		</table>
		
	</div>

	@endif
</div>
