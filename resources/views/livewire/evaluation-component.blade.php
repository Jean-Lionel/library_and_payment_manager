<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    @if($showForm)
	    <div>
	    	<h3>Ajout d'une evaluation</h3>
	    	<form action="" class="col-md-6" wire:submit.prevent="saveEvalution">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">Classe</label><br>
	    					<select name="" id="" wire:model="classeId" class="form-control">
	    						<option value=""></option>
	    						@foreach ($classes as $classe)
	    							{{-- expr --}}
	    							<option value="{{ $classe->id }}">{{ $classe->name }}</option>
	    						@endforeach
	    					</select>
	    					@error('classeId')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">Cours</label><br>
	    		
	    					<select name="" id="" wire:model="courId" class="form-control">
	    						<option value=""></option>
	    						@foreach ($cours as $cour)
	    							{{-- expr --}}
	    							<option value="{{$cour->id}}">
	    								{{$cour->name}}</option>
	    						@endforeach
	    					</select>

	    					@error('courId')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">TRIMESTRE</label><br>
	    					<select name="" wire:model="trimestre" class="form-control">
	    						<option value=""></option>
	    					@foreach ($trimestres as $trimestre)
	    						{{-- expr --}}
	    						<option value="{{$trimestre->id}}">{{$trimestre->name}}</option>
	    					@endforeach
	    					</select>

	    					@error('trimestre')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    					
	    				</div>
	    			</div>

	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">TYPE D'EVALUATION</label><br>
	    					<select name="" wire:model="type_evaluation" id="" class="form-control">
	    						<option value=""></option>
	    						<option value="INTERROGATION">INTERROGATION</option>
	    						<option value="EXAMEN">EXAMEN</option>
	    					</select>

	    					@error('type_evaluation')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">DATE DE PASSASSION</label><br>
	    					<input type="date" wire:model="date_evaluation">
	    					@error('date_evaluation')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">Ponderation</label><br>
	    					<input class="form-control" type="number" wire:model="ponderation">
	    					@error('ponderation')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">A\S</label><br>
	    					<h3>{{$currentAnneScolaire->name }}</h3>
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<br>
	    					<button class="btn btn-block btn-outline-dark">Valider</button>
	    				</div>
	    			</div>
	    		</div>
	    		
	    	</form>
	    </div>
    @else
    <div>
    	<button wire:click="toogleForm" class="btn btn-primary" title="Nouvelle Evaluation"><i class="fa fa-plus"></i></button>
    	<table class="table table-sm">
    		<thead>
    			<tr>
    				<th>NUMERO</th>
    				<th>CLASSE</th>
    				<th>COURS</th>
    				<th>PONDERATION</th>
    				<th>DATE</th>
    				<th>ACTION</th>
    			</tr>
    			
    		</thead>
    		<tbody>
    			@foreach ($evaluations as $evaluation)
    				{{-- expr --}}
    				<tr>
    					<td>{{ $evaluation->id }}</td>
    					<td>{{ $evaluation->classe->name }}</td>
    					<td>{{ $evaluation->cour->name }}</td>
    					<td>{{ $evaluation->ponderation }}</td>
    					<td>{{ $evaluation->date_evaluation }}</td>
    					<td>
    						<button wire:click="modifierEvaluation({{$evaluation->id }})">
    							<i class="fa fa-edit"></i>
    						</button>
    						<a href="{{ route('add_point',$evaluation->id ) }}" class="btn btn-primary" title="Ajout des points des élèves">
    							<i class="fa fa-plus"></i>
    						</a>
    						
    						
    					</td>
    				</tr>
    			@endforeach
    		</tbody>
    	</table>

    	<div>
    		{{$evaluations->links()}}
    	</div>
    	
    </div>
    @endif
</div>
