<div class="col-md-8 offset-md-2">
	<div class="row">
		<div class="form-group col-6">
			<input type="hidden" name="classe_id" value="{{ $classe->id ?? old('classe_id') }}">
			<label for="first_name">NOM</label>
			<input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" name="first_name" value="{{ old('first_name') ?? $eleve->first_name?? ' ' }}">
			{!! $errors->first('first_name', '<small class="help-block  invalid-feedback">:message</small>') !!}
		
	  </div>
	  <div class="form-group col-6">
		<label for="last_name">PRENOM</label>
		<input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" name="last_name" value="{{ old('last_name') ?? $eleve->last_name?? ' ' }}">
		{!! $errors->first('last_name', '<small class="help-block invalid-feedback">:message</small>') !!}	
	  </div>
	</div>
	  <div class="row">
		<div class="form-group col-6">
			<input type="hidden" name="classe_id" value="{{ $classe->id ?? old('classe_id') }}">
			<label for="date_naissance">DATE DE NAISSANCE</label>
			<input type="date" class="form-control {{$errors->has('date_naissance') ? 'is-invalid' : '' }}" id="date_naissance" name="date_naissance" value="{{ old('date_naissance') ?? $eleve->date_naissance?? ' ' }}">
			{!! $errors->first('date_naissance', '<small class="help-block invalid-feedback">:message</small>') !!}
	  </div>
	  <div class="form-group col-6" style="font-size: 20px; cursor: pointer;">
		<label for="sexe">SEXE</label> <br>
		<input type="radio" @if(isset($eleve->sexe)  and $eleve->sexe == "M") checked @endif name="sexe" id="homme" value="M" title="MASCULIN"> 
		<label for="homme">MASCULIN</label>
		
		<input type="radio" @if(isset($eleve->sexe)  and $eleve->sexe == "F") checked @endif id="femme" name="sexe" value="F">
		<label for="femme">FEMININ</label>
		{!! $errors->first('sexe', '<small class="help-block invalid-feedback">:message</small>') !!}
		
	  </div>

		

	</div>

	<div class="row">
		<div class="form-group col-6">
			
			<label for="nationalite">NATIONALITE</label>
			<input type="text" class="form-control {{$errors->has('nationalite') ? 'is-invalid' : '' }}" id="nationalite" name="nationalite" value="{{ old('nationalite') ?? $eleve->nationalite?? 'BURUNDAISE ' }}">
			{!! $errors->first('nationalite', '<small class="help-block invalid-feedback">:message</small>') !!}
		
	  </div>

	  <div class="form-group col-6">
		<label for="address">ADRESSE</label>
		<input type="text" class="form-control {{$errors->has('address') ? 'is-invalid' : '' }}" id="address" name="address" value="{{ old('address') ?? $eleve->address?? ' ' }}">
		{!! $errors->first('address', '<small class="help-block invalid-feedback">:message</small>') !!}
		
	  </div>

	</div>

	<button type="submit" class="btn btn-primary">{{ $btn_name }}</button>


	<a href="{{ route('classes.show',$classe) }}" class="btn btn-warning">Retour</a>

</div>
