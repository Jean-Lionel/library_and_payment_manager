
<div class="col-md-8 offset-md-2">
	<div class="form-group">
		<label for="name">Niveau :</label>
		
		<select class="form-control" name="level_id" id="level_id">
			<option value=""></option>
			@foreach ($levels as $element)
			{{-- expr --}}
			<option  value="{{ $element->id }}" 

				@if ($classe->level_id ==  $element->id)
					{{-- expr --}}
					selected 
				@endif
				>
				{{ $element->section->name }} - 
				{{ $element->name }}</option>
		    @endforeach
		</select>
		
		{!! $errors->first('level_id', '<small class="help-block invalid-feedback">:message</small>') !!}
	</div>
	<div class="form-group">
		<label for="name">CLASSE</label>
		<input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' : '' }}" id="name" name="name" value="{{ old('name') ?? $classe->name?? ' ' }}">
		{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}

		
	</div>


	<button type="submit" class="btn btn-primary">{{ $btn_name }}</button>

	


</div>