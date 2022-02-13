@extends('layouts.base')

@section('content')

<div>
	@include('courses.header')

	<div class="container">
		<form action="{{ route('get_notes') }}" method="post" class="row">
			{{-- //SECTION
			//CLASSE
        //COURS
        //TRIMESTRE
        // ANNEE SCOLAIRE --}}

        @csrf
        @method('post')

        <div class="form-group col-md-3">
        	<label for="">SECTION</label>

        	<select name="section_id" required id="section_id" class="form-control">
        		<option value=""></option>
        		@foreach ($sections as $section)
        			{{-- expr --}}
        			<option value="{{ $section->id }}"

        				@if($select_section == $section->id) selected  @endif

        			 >{{ $section->name }}</option>
        		@endforeach
        		
        	</select>
        </div> 
        <div class="form-group col-md-3">
        	<label for="">Classe</label>

        	<select name="classe_id" required id="classe_id" class="form-control">
        		<option></option>
        		@foreach ($classes as $classe)
        			{{-- expr --}}
        			<option value="{{ $classe->id }}"
        				@if($select_classe == $classe->id ) selected @endif
        				>{{ $classe->name }}</option>
        		@endforeach
        		
        	</select>
        </div> 
          <div class="form-group col-md-3">

        	<label for="">Cours</label>

        	<select name="cours_id" required id="" class="form-control">
        		<option value=""></option>
        		@foreach ($choosedClasse->courses() ?? [] as $cour)
        			<option value="{{ $cour->id }}">{{ $cour->name }}</option>
        		@endforeach
        		
        	</select>
        </div>
         <div class="form-group col-md-3">
        	<label for="">TRIMESTRE</label>

        	<select name="trimestre" required id="trimestre" class="form-control">
        		<option value=""></option>
        		@foreach($trimestres as $trimestre)
        		<option value="{{ $trimestre->id }}">{{ $trimestre->name }}</option>

        		@endforeach
            {{--  FICHES DES POINTS DE TOUT LES TRIMESTRES --}}
            <option value="FICHE">FICHE DES POINTS</option>
        	</select>
        </div>

        <div class="form-group col-md-3">
        	<label for="">Année Scolaire</label>

        	<select name="annee_scolaire" required id="annee_scolaire" class="form-control">
        		<option value=""></option>
        		@forelse ($annee_scolaires as $annee_scolaire)
        			<option value="{{ $annee_scolaire->id }}">{{ $annee_scolaire->name }}</option>
        		@empty
        			{{-- empty expr --}}
        		@endforelse
        		
        	</select>
        </div>

        <div class="form-group col-md-3">
        	<label for="" class=""></label>
        	<button type="submit" class="btn btn-primary  form-control">Afficher</button>
        	
        </div>
      
       

		</form>
	</div>

</div>

@stop

@section('javascript')
      
      <script>

      	$("#section_id").on('change', function(e){
      		const section_id = e.target.value;
      		 window.location.href = 'notes?section='+ section_id
      	})
      	$("#classe_id").on('change', function(e){
      		const classe_id = e.target.value;

      		var section_id = location.search.split('section=')[1]

      		window.location = 'notes?section='+section_id+'&classe_id='+ classe_id
      		 
      	})
      </script>
 @endsection