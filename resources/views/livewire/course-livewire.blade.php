<div class="row">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    @if ($showForm)
        {{-- expr --}}
    
    <div class="offset-2 col-md-6">
    	<h5 class="text-center">Ajouter un cours</h5>
    	<form action="" wire:submit.prevent="saveCourse" class="row">

    		<div class="form-group col-md-6">
    			<label for="">TITLE DU COURS 
                </label>
    			<input type="text" wire:model="name" class="form-control form-control-sm">

                <label for="principale">
                    Marque comme un cours Principal
                     <input id="principale" type="checkbox" wire:model="status">
                </label>
                @error('name')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
                <br>
                <label for="conduite">Conduite</label>
                <input type="checkbox" id="conduite" wire:model="conduite">
    		</div>

             <div class="form-group col-md-6">
                <label for="">CATEGORIE</label>
                <select name="" id="" wire:model="category_id" class="form-control form-control-sm">
                    <option value="">...........</option>
                    @foreach ($categories as $category)
                        {{-- expr --}}
                    <option value="{{$category->id}}">{{$category->name}}  </option>
                    @endforeach
                </select>
                @error('classe_id')
                <p class="category_id-danger text-center"> {{ $message }}</p>
                @enderror
            </div>

    		<div class="form-group col-md-6">
    			<label for="">PODERATION TJ TRIMESTRIELLE</label>
    			<input type="number" min="0" wire:model="ponderation" class="form-control form-control-sm">
                @error('ponderation')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
    		</div>
            <div class="form-group col-md-6">
                <label for="">PODERATION COMPÉTENCE </label>
                <input type="number" min="0" wire:model="ponderation_compentance" class="form-control form-control-sm">
                @error('ponderation_compentance')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="">PODERATION RESSOURCE / EXAMEN </label>
                <input type="number" min="0" wire:model="ponderation_examen" class="form-control form-control-sm">
                @error('ponderation_examen')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
            </div>
            
            
            <div class="form-group col-md-6">
                <label for="credit">CREDIT / HS</label>
                <input type="number" id="credit" wire:model="credit" value="0" class="form-control form-control-sm">
                @error('credit')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
            </div>

    		<div class="form-group col-md-6">
    			<label for="">PROFESSEUR</label>
    			<select name="" id="" wire:model="professeur_id" class="form-control form-control-sm">
    				<option value="">...........</option>
    				@foreach ($professeurs as $element)
    					{{-- expr --}}
    					<option value="{{$element->id}}">{{$element->name}}</option>
    				@endforeach
    			</select>

                @error('professeur_id')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
    		</div>
    		<div class="form-group col-md-6">
    			<label for="">SECTION | NIVEAU</label>
    			<select name="" id="" wire:model="level_id" class="form-control form-control-sm">
    				<option value="">...........</option>
    				@foreach ($levels as $element)
    					{{-- expr --}}
    				<option value="{{$element->id}}">{{ucfirst($element->section->name)}} | {{$element->name}}  </option>
    				@endforeach
    			</select>
                @error('level_id')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
    		</div>
            
    		<div class="form-group mt-3 col-md-6">
    			<button type="submit" class="btn btn-info btn-block">Enregistrer</button>
    		</div>
    	</form>
    	
    </div>

    @else

    <div class="col-md-12">
       <h4 class="text-center">Liste des cours</h4>
        <div class="row">
            <div class="col">
               <input type="text" wire:model="search" placeholder="Rechercher">
            </div>
            <div class="col text-right">
                <button class="btn btn-sm btn-info" wire:click="$set('showForm', true)">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
       
        <table class="table tab-content table-sm table-hover">
            <thead>
                <tr>
                    <th>NOM DU COURS</th>
                    <th>CATEGORIE</th>
                    <th>PONDERATION</th>
                    <th>CREDIT / HS</th>
                    <th>NIVEAU</th>
                    <th>PROFESSEUR</th>
                    <th>ACTION</th>
                </tr>
                
            </thead>

            <tbody>
            @foreach ($courses as $course)
            {{-- expr --}}
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->category->name ?? "" }}</td>
                <td>{{ $course->ponderation }}</td>
                <td>{{ $course->credit }}</td>
                <td>{{ $course->level->name ?? "" }}</td>
                <td>{{ $course->professeur->name ?? "" }}</td>
                <td><button class="btn-info btn-sm" wire:click="updateCourse({{ $course->id }})">
                     Modifier</button></td>
            </tr>
            @endforeach 
            </tbody>
        </table>

        {{ $courses->links()}}

       
    </div>

    @endif
        
</div>
