<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="row">
        <h3>Veiller configurer la calendrier de cette année scolaire</h3>
        <div class="col-md-12">
            <a href="{{ route('configurations_component') }}">
                configuration des paramètres essentiels
            </a>
        </div>
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
    			<h3>ANNEE SCOLAIRE : {{ $currentAnneScolaire ? $currentAnneScolaire->name : ""}}</h3>
    			</li>
    		</ul>
    	</div>
    	<div class="col">
            <h4>Trimestre</h4>

            <select wire:model="choosedTrimestre" class="form-control" id="">
                <option value=""></option>
                @foreach ($trimestres as $trim)
                    {{-- expr --}}
                    <option value="{{$trim->id}}"

                        @if ($trim->is_current == 1)
                            {{-- expr --}}
                            selected
                        @endif

                        >{{$trim->name }}</option>
                @endforeach
            </select>

            <h5>{{$curreTrimestre ?  $curreTrimestre->name : ""}}</h5>

        </div>
    	<div class="col">
            <h3>La 1ére période débute de ... jusqu'au ....</h3>
        </div>
    	<div class="col">
            <h3>La 2ére période ... jusqu'au ....</h3>
        </div>
    </div>
</div>
