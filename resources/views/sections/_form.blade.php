
<div class="col-md-8 offset-md-2">
	<div class="form-group">
		<label for="name">DESIGNATION</label>
		<input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name') ?? $section->name?? ' ' }}">
		{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
		
	</div>
	<button type="submit" class="btn btn-primary">{{ $btn_name }}</button>

</div>
