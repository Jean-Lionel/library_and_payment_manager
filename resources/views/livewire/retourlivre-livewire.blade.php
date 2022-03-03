<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    <div class="row">
    	<div class="col-md-6">
    		<h5>Liste des personnes qui n'ont pas encore remis les livres qu'ils ont retirés</h5> 

    		<div class="row">
    			<label for="">Rechercher ici !!!</label> <input placeholder="Entre le nom ou le prenom" type="text" wire:model="searchName">
    		</div>

    		<table class="table table-sm table-striped">
    			<thead>
    				<tr>
    					<th>Numéro</th>
    					<th>Nom et prénom</th>
    					<th>Classe</th>
    					<th>Section</th>
    					<th>Action</th>

    				</tr>
    			</thead>

    			<tbody>


    				@foreach($eleves as $eleve)

    				<tr>
    					<td>{{ $eleve->compte->name }}</td>
    					<td>{{ $eleve->fullName }}</td>
    					<td>{{ $eleve->classe->name }}</td>
    					<td>{{ $eleve->classe->section->name }}</td>
    					<td><button wire:click="searchStudent({{ $eleve->id }})" class="btn-info"> <i class="fa fa-check"></i> sélectionner </button></td>
    				</tr>

    				@endforeach
    			</tbody>
    		</table>

    		{{ $eleves->links() }}

    		@if($detailEmprunt)
    		<div>

    			<form action="" wire:submit.prevent="validerRemet" >
    				@foreach($detailEmprunt->detailsBooks as $detail)
    				<div class="form-group d-flex">

                        @if($detail->etat == 'NON REMIS')
    					<label class="w-75" for="">{{ $detail->book->title }}</label>
    					<input min="1" wire:model="numberLivre.{{ $detail->id }}"  type="checkbox" value="{{$detail->quantite  }}" class="form-control">

                        @endif
    				</div>

    				@endforeach			

    				<button >Valider</button>
    			</form>
    			
    		</div>

    		@endif
    	</div>

    	<div class="col-md-6">
    		@if($selectStudent)
    		

    		<div class="card" style="max-height:700px; overflow: scroll;">
    			<h6 class="text-center">INFORMATION DU LECTEUR</h6>

    			<div class="card-body">
    				<div class="d-flex justify-content-between">
    					<div>
    						<span>Nom et prénom : <b>{{ $selectStudent->fullName }}</b></span>
    					</div>

    					<div>
    						
    						@foreach($selectStudent->empruts as $emprut)
    						
    						<ul style="list-style: none;">
    							<li>EMPRUNT NUMERO :  {{ $emprut->id }}</li>

    							<li>
    								<ul >
    									
    									@foreach($emprut->detailsBooks as $detail)
                                        @if($detail->etat == 'NON REMIS')
    									   <li>TITRE : <b> {{ $detail->book->title }}</b></li>
    									   <li>QUANTITE : <b> {{ $detail->quantite }}</b></li>

                                        @endif
    							        @endforeach
    								</ul>
    							</li>

    							<li>
    								<button wire:click="validerRetour({{ $emprut->id  }})">Valider</button>
    							</li>
    							
    						</ul>
    						<hr>
    						@endforeach
    					</div>
    					
    				</div>

    				
    			</div>


    		</div>


    		@endif
    	</div>
    </div>
</div>
