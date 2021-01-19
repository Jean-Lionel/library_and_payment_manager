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
        
        	<select wire:model="type_paiement" id="" class="form-control">
        		<option value="">Choisissez ...</option>
        		<option value="PAYE">Ceux qui ont payé</option>
        		<option value="NON PAYE">Ceux qui n'ont pas payé</option>
        		
        	</select>
        </div>
        <div class="col-md-3">
            <input type="text" wire:model="searchKey" placeholder="Rechercher ici " class="form-control">
        </div>

    </div>


    <table class="table table-bordered table-sm">
    	<thead>
    		<tr>
    			<th>Numéro</th>
                <th>Classe</th>
                <th>Nom et prénom</th>
                <th>Montant</th>
               
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
          @foreach($eleves as $key =>$paeiment)
          <tr>
             <td>{{ ++$key }}</td>
             <td>{{ $paeiment->eleve->classe->name }}</td>
             <td>{{ $paeiment->eleve->first_name }} {{ $paeiment->eleve->last_name }}</td>
             <td>{{ $paeiment->amount }}</td>
           
         </tr>

         @endforeach
     </tbody>
 </table>
</div>
