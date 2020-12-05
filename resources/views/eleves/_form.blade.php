
<div class="col-md-8 offset-md-2">
	<div class="form-group">
		<input type="hidden" name="classe_id" value="{{ $classe->id ?? old('classe_id') }}">
		<label for="first_name">NOM</label>
		<input type="text" class="form-control {{$errors->has('first_name') ? 'is-invalid' : '' }}" id="first_name" name="first_name" value="{{ old('first_name') ?? $eleve->first_name?? ' ' }}">
		{!! $errors->first('first_name', '<small class="help-block invalid-feedback">:message</small>') !!}
		
	</div>

	<div class="form-group">
		<label for="last_name">PRENOM</label>
		<input type="text" class="form-control {{$errors->has('last_name') ? 'is-invalid' : '' }}" id="last_name" name="last_name" value="{{ old('last_name') ?? $eleve->last_name?? ' ' }}">
		{!! $errors->first('last_name', '<small class="help-block invalid-feedback">:message</small>') !!}
		
	</div>

	<button type="submit" class="btn btn-primary">{{ $btn_name }}</button>


	<a href="{{ route('classes.show',$classe) }}" class="btn btn-warning">Retour</a>

</div>
