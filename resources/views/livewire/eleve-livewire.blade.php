<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

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

                <select name="" wire:model="selectedClasse" id="" class="form-control">
                    <option value="">Choisissez une classe</option>

                    @foreach($classes as $classe)

                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <input type="text" placeholder="Rechercher ici " class="form-control">
        </div>


        @if($selectedClasse)
        <div class="col-md-3">
            <a class="btn-primary btn btn-block" href="{{ route('eleves.create', ['id' => $selectedClasse]) }}">Nouveau Elève</a>
        </div>
        @endif

    </div>


    <table class="table table-bordered table-sm">
    	<thead>
    		<tr>
    			<th>#</th>
                <th>Section</th>
                <th>Classe</th>
                <th>Numéro de compte</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach($eleves as $eleve)
          <tr>
             <td>{{ $eleve->id }}</td>
             <td>{{ $eleve->classe->section->name }}</td>
              <td>{{ $eleve->classe->name }}</td>
             <td>{{ $eleve->compte->name ?? "" }}</td>
            
             <td>{{ $eleve->first_name }}</td>
             <td>{{ $eleve->last_name }}</td>
             <td></td>
         </tr>

         @endforeach
     </tbody>
 </table>
</div>
