<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}

    @if(session()->has('error'))
	<div class="alert alert-danger">
			{{ session()->get('error') }}
	</div>
	@endif

    @if($showForm)
	    <div class="container pt-5 border px-5 py-5  border-dark bg-white mt-3">
	    	<h4 class="text-center text-uppercase">Ajout d'une evaluation</h4>
	    	<form  wire:submit.prevent="saveEvalution">
	    		<div class="row">
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">Classe</label><br>
	    					<select name="" id="" wire:model="classeId" class="form-control rounded-0">
	    						<option value=""></option>
	    						@foreach ($classes as $classe)
	    							{{-- expr --}}
	    							<option value="{{ $classe->id }}">{{ $classe->name ?? "" }}</option>
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

	    					<select name="" id="" wire:model="courId" class="form-control rounded-0">
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
	    					<h4>{{ $trimestre->name }}</h4>


	    					@error('trimestre')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror

	    				</div>
	    			</div>

	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">TYPE D'EVALUATION</label><br>
	    					<select name="" wire:model="type_evaluation" id="" class="form-control rounded-0">
	    						<option value=""></option>
	    						<option value="INTERROGATION">INTERROGATION</option>
	    						<option value="EXAMEN">EXAMEN</option>
                                <option value="DEVOIR">DEVOIR</option>
	    						<option value="COMPENTENCE">COMPENTENCE</option>
	    					</select>

	    					@error('type_evaluation')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">DATE DE PASSASSION</label><br>
	    					<input type="date" wire:model="date_evaluation" class="form-control rounded-0">
	    					@error('date_evaluation')
	    					<span class="text-danger">{{ $message }}</span>
	    					@enderror
	    				</div>
	    			</div>
	    			<div class="col-md-6">
	    				<div class="form-group">
	    					<label for="">Max</label><br>
	    					<input class="form-control rounded-0" min="0" type="number" wire:model="ponderation">
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
	    					<button class="btn btn-info text-white w-100">Valider</button>
	    				</div>
	    			</div>
	    		</div>

	    	</form>
	    </div>
    @else
    <div>

    	<div class="row">
    		<div class="col-md-1">
    			<button wire:click="toogleForm" class="btn btn-primary" title="Nouvelle Evaluation"><i class="fa fa-plus"></i></button>
    		</div>
    		<div class="col-md-5">
    			<input type="text" wire:model="search" placeholder="Recherche " class="form-control form-control-sm">
    		</div>
    	</div>
    	<table class="table table-sm">
    		<thead>
    			<tr>
    				<th>NUMERO</th>
    				<th>CLASSE</th>
    				<th>COURS</th>
    				<th>TYPE</th>
    				<th>PONDERATION</th>
    				<th>TRIMESTRE</th>
    				<th>A\S</th>
    				<th>DATE</th>
    				<th>ACTION</th>
    			</tr>

    		</thead>
    		<tbody>
    			@foreach ($evaluations as $evaluation)
    				{{-- expr --}}
    				<tr>
    					<td>{{ $evaluation->id }}</td>
    					<td>{{ $evaluation->classe->name ?? ""}}</td>
    					<td>{{ $evaluation->cour->name  ?? ""}}</td>
    					<td>{{ $evaluation->type_evaluation }}</td>
    					<td>{{ $evaluation->ponderation }}</td>
	    					<td>{{ $evaluation->trimestre }}</td>
    					<td>{{ $evaluation->date_evaluation }}</td>

    					<td>{{ $evaluation->date_evaluation }}</td>
    					<td>

    						<button class="btn-danger" wire:click="$emit('triggerDelete',{{ $evaluation->id }})">
    							<i class="fa fa-remove"></i>
    						</button>
    						<button title="Modifier" wire:click="modifierEvaluation({{$evaluation->id }})">
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


@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerDelete', orderId => {
            Swal.fire({
                title: 'Vous êtez sûr ?',
                text: "D'annuler d' evaluation",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'var(--danger)',
                cancelButtonColor: 'var(--primary)',
                confirmButtonText: 'OK'
            }).then((result) => {
		//if user clicks on delete
                if (result.value) {
		     // calling destroy method to delete
                    @this.call('annulerEvalution',orderId)
		    // success response
                    responseAlert({title: session('message'), type: 'success'});

                } else {
                    responseAlert({
                        title: 'Operation Cancelled!',
                        type: 'success'
                    });
                }
            });
        });
    })
</script>
@endpush



