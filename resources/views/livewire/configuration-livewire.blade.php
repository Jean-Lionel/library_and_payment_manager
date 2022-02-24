<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="row">
    	<div class="col">
    		<button wire:click="$set('showInputYear', true)" class="btn btn-primary btn-sm">Ajouter l'année scolaire</button>

    		@if($showInputYear)
    		<form action="" class="mt-4" wire:submit.prevent="saveYear()">
    			<input type="text" wire:model="annee">
    			<button class="btn btn-info">Enregistrer</button>
    		</form>

    		@endif

    		<ul class="list-group">
    			<li class="list-group-item">
    			<h3>ANNEE SCOLAIRE : {{ $currentAnneScolaire->name ?? ""}}</h3> 
    			</li>
    		</ul>
    	</div>
    	<div class="col">
            <h4>Trimestre</h4>
            
        </div>
    	<div class="col"></div>
    	<div class="col"></div>
    </div>
</div>
