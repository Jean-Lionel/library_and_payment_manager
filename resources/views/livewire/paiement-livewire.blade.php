<div>
	{{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

	<div class="row">
		<div class="col-md-3">
			<button wire:click="showForm" class="btn btn-primary"> Nouveau Paiment</button>
		</div>

		{{-- Impression du recu --}}

		@if($facture and $showFacture)
			<div>
					
						<div>
							<button onclick="clickButton()">Imprimer</button>
							<button wire:click="closeBill">Fermer</button>
						</div>
						<div class="main-content" id="main-content">
							<header>
								<h4>ECOLE : XXXX XXXX</h4>
								<h4>A/S : {{ $facture->annee_scolaire ?? "" }}</h4>
								<h4 style="text-align: center;">RECU N° {{ $facture->id }}</h4>
								<hr>
							</header>
							<section>
								<p>Bordereau N° : {{ $facture->bordereau }} </p>
								<p>Classe : {{ $facture->eleve->classe->name }}</p>
								
								<p>Compte de l'élève : {{ $facture->compte_name }} </p>
								<p>Nom et prénom : {{ $facture->eleve->fullName }}</p>
								<p>Montant Payé : {{ $facture->amount }} <br>
									Nous disons :  <span id="montant_lettre">
										{{$number_letter}} 
									</span>
								</p>
								<p>FRAIS : {{ $facture->type_paiement }} DU {{ $facture->trimestre }}</p>

								<div style="display: flex;justify-content: space-between;">
									<p>Signature de l'élève</p>
									<p>Signature du caissier</p>
									
								</div>

								<p style="text-align: center;">
									Date : {{ $facture->created_at }}
								</p>
							</section>
						</div>			

			</div>

		@endif


		{{-- Apres l'Impression du recu --}}

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
											<input type="number" wire:model="montant" class="form-control" id="montant" placeholder="Montant">

											@error('montant') <span class="error text-danger">{{ $message }}</span> @enderror
										</div>
									</div>

								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label for="montant" class="col-sm-4 col-form-label">Bordereau N°</label>
										<div class="col-sm-8">
											<input wire:model="bordereau" type="text" class="form-control" id="bordereau" placeholder="">

											@error('bordereau') <span class="error text-danger">{{ $message }}</span> @enderror
										</div>
									</div>
									
								</div>

								<div class="col-md-6">
									<div class="form-group row">
										<label  class="col-sm-4 col-form-label" for="">Periode</label>

										<select  wire:model="trimestre" name="" id="" class="form-control col-sm-8">
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

										@error('trimestre') <span class="error text-danger">{{ $message }}</span> @enderror
									</div>
								</div>

								<div class="col-md-6">
									<div class="d-flex justify-content-between">
										<label  for="">ANNE SCOLAIRE</label>
										<label for=""> <b>{{ $anneScolaire->name ?? "" }}</b> </label>

									</div>
								</div>


								<div class="col-md-6"> 
									<div class="form-group row">

										<label for="" class="col-sm-6">TYPE DE PAIMENT</label>

										<select class="col-md-6 form-control" wire:model="type_paiement" id="">
											<option value="">CHOISISSEZ ....</option>
											<option value="MINERVAL">MINERVAL</option>
											<option value="CONTRIBUTION">CONTRIBUTION</option>
										</select>
									</div>
								</div>

								<div class="col-md-6">
									@if($eleve and $compteName)

									<button type="submit" class="btn btn-primary btn-block">Enregistrer</button>

									@endif
								</div>
							</div>

						</div>

					</div>


				</form>
			</div>

			@endif
		</div>

		@if($paiements->count() >0)

		<table class="table table-sm">

			<thead>
				<tr>
					<th>ID</th>
					<th>COMPTE</th>
					<th>NOM ET PRENOM</th>
					<th>CLASSE</th>
					<th>MONTANT</th>
					<th>PERIODE</th>
					<th>BORDEREAU N° </th>
					<th>DATE</th>
					<th>Action</th>

				</tr>
			</thead>

			<tbody>
			@foreach($paiements as $paiment)
			<tr>
				<td>{{ $paiment->id }}</td>
				<td>{{ $paiment->compte_name }}</td>
				<td>{{ $paiment->eleve->fullName }}</td>
				<td>{{ $paiment->eleve->classe->name }}</td>
				<td>{{ $paiment->amount }}</td>
				<td>{{ $paiment->trimestre }}</td>
				<td>{{ $paiment->bordereau }}</td>
				<td>{{ $paiment->created_at }}</td>
				<td>
					
			

				<button  class="btn btn-sm btn-info" 
				wire:click="$emit('printBill',{{ $paiment  }})">Imprimer</button>

				
				</td>
			</tr>

			@endforeach
		</tbody>
		
	</table>

	@endif
<div>
	{{ $paiements->links() }}
</div>


</div>


@push('scripts')
<script type="text/javascript">		
//montant_lettre.innerHTML = "HELLO JE SUIS UN FUTURE MILLIARDAIRE"		
document.addEventListener('DOMContentLoaded', function () {


 @this.on('printBill', paiement =>{
 	let number_letter = NumberToLetter(paiement.amount);

 	@this.call('printBill',paiement.id,number_letter)
 	
 })

});
function clickButton(){
	printPage('main-content');
		// printJS({
		// 	printable: 'main-content',
		// 	css : "",
		// 	type : 'html'
		// });
}
</script>

@endpush
