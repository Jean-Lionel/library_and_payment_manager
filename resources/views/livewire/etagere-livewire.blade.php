<div>
    {{-- The best athlete wants his opponent at his best. --}}

 @include('livewire.alert-message')

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

    		<form wire:submit.submit="saveEtagere()">
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

        <div class="col-md-8">
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>DESIGNATION</th>
                    <th>DESCRIPTION</th>
                    <th>Action</th>
                </thead>

                <tbody>
                    @forelse($etageres as $key=>$etagere)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $etagere->name }}</td>
                        <td>{{ $etagere->description }}</td>
                        <td><button class="btn-info" wire:click="modifierEtager({{$etagere->id}})">Modifier</button></td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="4">
                            <h2>PAS DES ETAGERES DISPONIBLE</h2>
                        </td>
                    </tr>

                    @endforelse
                </tbody>
            </table>

            {{ $etageres->links() }}

     </div>
    </div>
</div>
