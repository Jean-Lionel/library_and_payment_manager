<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <style>
        .btn
           {
               background: #1A5684 !important;
               color: #ffffff;
           }
   </style>

    <div class="row">
        <div class="col-md-3">
            <select name="" wire:model="selectedSection" id="" class="form-control">
                <option value="">Choisissez une section</option>

                @foreach($sections as $section)

                <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <div class="form-group">

                <select name="selectedClasse" wire:model="selectedClasse" id="" class="form-control">
                    <option value="">Choisissez une classe</option>

                    @foreach($classes as $classe)

                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <input type="text" wire:model="searchKey" placeholder="Rechercher ici " class="form-control">
        </div>

        @canany(['is-admin','is-prefet'])
        @if($selectedClasse)
        <div class="col-md-3">
            <a class="btn-primary btn btn-block" href="{{ route('eleves.create', ['id' => $selectedClasse]) }}">Nouveau</a>
        </div>
        @endif
        @endcanany

        @canany(['is-admin','is-professeur'])
        <div class="col-md-3">
            <a class="btn-primary btn btn-block" href="3">Mes eleves</a>
        </div>
        @endcanany
    </div>

<div class="tabledata mt-3 card--container">
    <form method="POST" action="{{ route('presences.store') }}">
        @csrf
    <table class="table table-bordered table-sm ">
    	<thead>
    		<tr>
    			<th>#</th>
                <th>Photo</th>
                {{-- <th>Section</th>
                <th>Classe</th> --}}
                <th>Numéro de compte</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Adresse</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach($eleves as $key => $eleve)
          <tr>

            <td><input type="checkbox" value="{{ $eleve->id }}" name="eleve_id[]"/></td>
             {{-- <td>{{ ++$key }}</td> --}}
             <td><img src="{{ asset('uploads/eleve/' .$eleve->image_eleve) }}" alt="image" style="width: 44px; height: 44px; border-radius: 100%;"/></td>
             {{-- <td>{{ $eleve->classe->section->name }}</td>
              <td>{{ $eleve->classe->name }}</td> --}}
             <td>{{ $eleve->compte->name ?? "" }}</td>
             <td>{{ $eleve->first_name }}</td>
             <td>{{ $eleve->last_name }}</td>
             <td>{{ $eleve->sexe }}</td>
             <td>{{ $eleve->address }}</td>
             <td class="d-flex ">
                <a href="{{ route('eleves.edit', $eleve) }}" class="btn-sm btn-info mr-2">Modifier</a>

                {{-- <form action="{{ route('eleves.destroy', $eleve) }}" method="POST">
                  @csrf
                  @method('DELETE')

                  <button class="btn-sm btn-danger" onclick="return confirm('Etez-vous sûr ?')">Supprimer</button>
                </form> --}}
        </td>
         </tr>

         @endforeach
     </tbody>
 </table>
 <button class=" btn btn-sm  float-right">Enregistrer</button>
</form>
 {{ $eleves->links()}}
</div>
</div>
