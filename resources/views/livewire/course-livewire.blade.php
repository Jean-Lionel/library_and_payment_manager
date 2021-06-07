<div class="row">
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <div class="col-md-3">
    	<h5 class="text-center">Ajouter un cours</h5>
    	<form action="" wire:submit.prevent="saveCourse">
    		<div class="form-group">
    			<label for="">TITLE DU COURS</label>
    			<input type="text" wire:model="name" class="form-control">
                @error('name')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
    		</div>

             <div class="form-group">
                <label for="">CATEGORIE</label>
                <select name="" id="" wire:model="category_id" class="form-control">
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

    		<div class="form-group">
    			<label for="">PODERATION TRIMESTRIELLE</label>
    			<input type="number" wire:model="ponderation" class="form-control">

                @error('ponderation')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
    		</div>
            <div class="form-group">
                <label for="credit">CREDIT / HS</label>
                <input type="number" id="credit" wire:model="credit" value="0" class="form-control">
                @error('credit')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
            </div>

    		<div class="form-group">
    			<label for="">PROFESSEUR</label>
    			<select name="" id="" wire:model="professeur_id" class="form-control">
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
    		<div class="form-group">
    			<label for="">SECTION | CLASSE</label>
    			<select name="" id="" wire:model="classe_id" class="form-control">
    				<option value="">...........</option>
    				@foreach ($classes as $element)
    					{{-- expr --}}
    				<option value="{{$element->id}}">{{ucfirst($element->section->name)}} | {{$element->name}}  </option>
    				@endforeach
    			</select>
                @error('classe_id')
                <p class="text-danger text-center"> {{ $message }}</p>
                @enderror
    		</div>

           

            
    		<div class="form-group mt-3">
    			<button type="submit" class="btn btn-info btn-block">Enregistrer</button>
    		</div>
    	</form>
    	
    </div>


    <div class="col-md-8">
        <h4 class="text-center">Liste des cours</h4>
        <input type="text" wire:model="search" placeholder="Rechercher">
        <table class="table tab-content table-hover">
            <thead>
                <tr>
                    <th>NOM DU COURS</th>
                    <th>CATEGORIE</th>
                    <th>PONDERATION</th>
                    <th>CREDIT / HS</th>
                    <th>CLASSE</th>
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
                <td>{{ $course->classe->name }}</td>
                <td>{{ $course->professeur->name }}</td>
                <td><button wire:click="updateCourse({{ $course->id }})">
                     Modifier</button></td>
            </tr>
            @endforeach 
            </tbody>
        </table>

        {{ $courses->links()}}

       
    </div>
        
</div>
