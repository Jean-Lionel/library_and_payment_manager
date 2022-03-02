<div>
    {{-- Stop trying to control. --}}
        <form action="" wire:submit.prevent="saveConfiguration">
            <h4>Configuration des paramètres essentiels</h4>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Nom de l'etablissement</label>
                        <input type="text" wire:model="etablimssement" class="form-control">
                        @error('etablimssement')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Abbréviation</label>
                        <input type="text" wire:model="abbreviation" class="form-control">
                        @error('abbreviation')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Addresse</label>
                        <input type="text" wire:model="address" class="form-control">
                         @error('address')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Direction pronvicial</label>
                        <input type="text" wire:model="direction_provincial" class="form-control">
                         @error('direction_provincial')
                        <span class="error text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Direction communal</label>
                        <input type="text" wire:model="direction_communal" class="form-control">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-sm btn-primary" type="submit">Enregistrer</button>
                    </div>

                </div>
                <div class="col-md-4">

                </div>
            </div>
        </form>
</div>
