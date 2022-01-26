<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    
    <div>
        <select class="form-control-sm" wire:model="anne_scolaire_id">
            @foreach ($annee_scolaires as $element)
            {{-- expr --}}
            <option value=""></option>
            <option value="{{ $element->id }}">{{ $element->name }}</option>
          @endforeach
        </select>

        <button class="btn btn-sm btn-info" wire:click="searchEffectif">
            Rechercher
        </button>
    </div>
</div>
