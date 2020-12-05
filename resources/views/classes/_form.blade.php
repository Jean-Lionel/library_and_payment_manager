
<div class="col-md-8 offset-md-2">
	<div class="form-group">
		<label for="name">SECTION : {{ $section->name  }}</label>
		<input type="hidden" name="section_id" value="{{$classe->section_id ?? $section->id ?? old('section_id') }}">
		
		{!! $errors->first('section_id', '<small class="help-block invalid-feedback">:message</small>') !!}
	</div>
	<div class="form-group">
		<label for="name">CLASSE</label>
		<input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name') ?? $classe->name?? ' ' }}">
		{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

		
	</div>


	<button type="submit" class="btn btn-primary">{{ $btn_name }}</button>

	<a href="{{ route('sections.show',$section) }}" class="btn btn-warning">Retour</a>




</div>