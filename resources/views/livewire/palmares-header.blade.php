<div>
      {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    
    <div>
        <label for="">Année Scolaire</label>
        <select class="form-control-sm" wire:model="anne_scolaire_id">
            @foreach ($annee_scolaires as $element)
            {{-- expr --}}
            <option value=""></option>
            <option value="{{ $element->id }}">{{ $element->name }}</option>
          @endforeach
        </select>

        <label for="section_id">Section</label>

        <select name="" class="form-control-sm" id="section_id" wire:model="section_id">
            <option value=""></option>
            @foreach ($sections as $section)
                {{-- expr --}}
                <option value="{{ $section->id }}">{{ $section->name }}</option>
            @endforeach
            
        </select>
        <label for="">Classe</label>

        <select name="" wire:model="classe_id" class="form-control-sm">
            <option value=""></option>

            @foreach ($classes as $classe)
                {{-- expr --}}
                <option value="{{ $classe->id }}">{{ $classe->name }}</option>
            @endforeach
            
        </select>
        <label for="">Trimestre</label>
        <select name="" id="" wire:model="trimestre">
            <option value=""></option>

            @foreach ($trimestres as $trimestre)
                {{-- expr --}}
                <option value="{{ $trimestre->id }}">
                    {{ $trimestre->name }}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-info" wire:click="searchParmales">
            Rechercher
        </button>
    </div>
</div>

