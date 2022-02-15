<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div class="col-md-2">
            <select name="" wire:model="selectedSection" id="" class="form-control form-control-sm">
                <option value="">Choisissez une section</option>

                @foreach($sections as $section)

                <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <div class="form-group">

                <select name="" wire:model="selectedClasse" id="" class="form-control form-control-sm">
                    <option value="">Choisissez une classe</option>

                    @foreach($classes as $classe)

                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <input type="text"  wire:model="searchKey" placeholder="Rechercher ici " class="form-control form-control-sm">
        </div>
        <div class="col-md-3">
            {{ $eleves}}
        </div>

    </div>
</div>
