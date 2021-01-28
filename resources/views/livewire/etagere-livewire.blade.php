<div>
    {{-- The best athlete wants his opponent at his best. --}}

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

    <div class="row">
    	<div class="col-md-4">

    		<form wire:model.submit="saveEtagere()">
    			<div class="form-group">
    				<label>Nom de l'étagère</label>
    				<input class="form-control" type="text" wire:model="name" name="">
    			</div>

    			<div class="form-group">
    				<label>Déscription</label>
    				<textarea class="form-control"  wire:model="description"></textarea>
    			</div>
    			<div class="form-group">
    				<button class="btn btn-info">Enregistrer</button>
    			</div>
    		</form>
    		
    	</div>
    </div>
</div>
