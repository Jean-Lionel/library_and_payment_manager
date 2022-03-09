<div>
    {{-- The Master doesn't talk, he acts. --}}

    @if ($provinces)
    <div class="form-group">
        <label for="province">Province</label>
        <select name="province"  class="form-control form-control-sm" wire:model="province">
            <option value=""></option>
            @foreach ($provinces as $element)
                <option value="{{$element->region}}">{{$element->region}}</option>
            @endforeach
        </select>
    </div>

    @if ($communes)
        {{-- expr --}}
        <label for="province">Commune</label>
        <select name="commune"  class="form-control form-control-sm" wire:model="commune">
            <option value=""></option>
            @foreach ($communes as $element)
                <option value="{{$element->district ?? ""}}">{{$element->district ?? ""}}</option>
            @endforeach
        </select>
    @endif

    @if ($collines)
        {{-- expr --}}
        <label for="province">Colline | Quartier</label>
        <select  class="form-control form-control-sm" name="colline" wire:model="colline">
            <option value=""></option>
            @foreach ($collines as $element)
                <option value="{{$element->city ?? ""}}">{{$element->city ?? ""}}</option>
            @endforeach
        </select>
    @endif

    @endif
</div>
