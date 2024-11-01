<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    <div class="container pt-5 border px-5 py-5  border-dark bg-white mt-3">
        <div class="form-group">
            <label for="">Année Scolaire</label>
            <select class="form-control" wire:model="anne_scolaire_id">
                @foreach ($annee_scolaires as $element)
                    {{-- expr --}}
                    <option value=""></option>
                    <option value="{{ $element->id }}">{{ $element->name }}</option>
                @endforeach
            </select>
            @error('anne_scolaire_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="section_id">Section</label>
            <select name="" class="form-control" id="section_id" wire:model="section_id">
                <option value="">--Selectionner--</option>
                @foreach ($sections as $section)
                    {{-- expr --}}
                    <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach

            </select>
            @error('section_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">Classe</label>
            <select name="" wire:model="classe_id" class="form-control">
                <option value="">--Selectionner--</option>

                @foreach ($classes as $classe)
                    {{-- expr --}}
                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                @endforeach

            </select>

            @error('classe_id')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">


            <label for="">Trimestre</label>
            <select name="" id="" wire:model="trimestre" class="form-control">
                <option value="">--Selectionner--</option>

                @foreach ($trimestres as $trimestre)
                    {{-- expr --}}
                    <option value="{{ $trimestre->id }}">
                        {{ $trimestre->name }}</option>
                @endforeach
            </select>
            @error('trimestre')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <button class="btn btn-sm btn-info w-100" wire:click="searchParmales">
            Rechercher
        </button>
    </div>
</div>
