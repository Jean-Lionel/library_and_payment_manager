<div>
	{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

	<div class="row">
		<div class="col-md-3">
			<button wire:click="showForm" class="btn btn-primary"> Nouveau Paiment</button>
		</div>

		@if($showFormulaire)
		<div class="col-md-12">
			
			<form wire:submit.prevent="savePaiement">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group row">
							<label for="compte_name" class="col-sm-4 col-form-label">COMPTE</label>
							<input class="col-sm-8 form-control form-control-sm" type="text" wire:model="compteName">

							@if($eleve and $compteName)

							<div class="col-md-12">
								
								
								<ul class="list-group">
									<li class="list-group-item">
										Nom et Prénom : <b>{{ $eleve->first_name.' '. $eleve->last_name}} </b></li>
										<li class="list-group-item">

											COMPTE : <b>{{ $eleve->compte->name  }}</b>

										</li>
										<li class="list-group-item">
											<span>CLASSE : {{ $eleve->classe->name }}</span>

										</li>
									</ul>

								</div>

								@endif
							</div>
						</div>

						<div class="col-md-8">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label for="montant" class="col-sm-4 col-form-label">Montant</label>
										<div class="col-sm-8">
											<input type="number" class="form-control" id="montant" placeholder="Montant">
										</div>
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="montant" class="col-sm-4 col-form-label">Bordereau N°</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" id="montant" placeholder="Montant">
										</div>
									</div>
									
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label  class="col-sm-4 col-form-label" for="">Periode</label>

										<select  name="" id="" class="form-control col-sm-8">
											<option value="">Choisissez ici le trimestre</option>

											<option value="PREMIER TRIMESTRE">
												PREMIER TRIMESTRE
											</option>
											<option value="DEUXIEME TRIMESTRE">
												DEUXIEME TRIMESTRE
											</option>
											<option value="TROISIEME TRIMESTRE">
												TROISIEME TRIMESTRE
											</option>

											
										</select>
									</div>
								</div>

								<div class="col-md-6">
									<div class="d-flex justify-content-between">
										<label  for="">ANNE SCOLAIRE</label>
										<label for=""> <b>{{ $anneScolaire->name }}</b> </label>
									
									</div>
								</div>

								@if($eleve and $compteName)

								 <button type="submit">Enregistrer</button>

								@endif
							</div>

						</div>

					</div>


				</form>
			</div>

			@endif
		</div>

		<table class="table table-sm">

			<thead>
				<tr>
					<th>COMPTE</th>
					<th>NOM ET PRENOM</th>
					<th>MONTANT </th>
					<th>PERIODE </th>
					<th>BORDEREAU N° </th>
					<th>DATE</th>

				</tr>
			</thead>

			<tbody>
			{{-- @foreach($paiements as $paiment)
			<tr>
				<td></td>
			</tr>

			@endforeach --}}
		</tbody>
		
	</table>


</div>
