<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Ajouter une Punition
        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit.prevent="submit">
                <div class="form-group mb-3">
                    <label for="type_punition_id">Type de Punition</label>
                    <input type="text" id="type_punition_id" wire:model="type_punition_id" class="form-control @error('type_punition_id') is-invalid @enderror">
                    @error('type_punition_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <textarea id="description" wire:model="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="date_punition">Date de la Punition</label>
                    <input type="date" id="date_punition" wire:model="date_punition" class="form-control @error('date_punition') is-invalid @enderror">
                    @error('date_punition') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="statut">Statut</label>
                    <input type="text" id="statut" wire:model="statut" class="form-control @error('statut') is-invalid @enderror">
                    @error('statut') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="eleve_id">ID Élève</label>
                    <input type="text" id="eleve_id" wire:model="eleve_id" class="form-control @error('eleve_id') is-invalid @enderror">
                    @error('eleve_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="enseignant_id">ID Enseignant</label>
                    <input type="text" id="enseignant_id" wire:model="enseignant_id" class="form-control @error('enseignant_id') is-invalid @enderror">
                    @error('enseignant_id') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-success">Ajouter</button>
            </form>
        </div>
    </div>
</div>
