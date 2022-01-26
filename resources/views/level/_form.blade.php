<div>
	<div class="col-md-4 ofset-md-4">
		<div class="form-group">
			<label for="">Nom</label>
			<input class="form-control" type="text" name="name">
			@error('name')
			<span class="text-danger text-center">{{ $message }}</span>
			@enderror
		</div>
		<div class="form-group">

			<label for="section_id">Niveau</label>
			<select class="form-control" required 
			name="section_id" id="">
				<option value=""></option>
				@foreach ($sections as $element)
				<option value="{{ $element->id }}">{{  $element->name }}</option>
				@endforeach

			</select>
			@error('section_id')
			<span class="text-danger text-center">{{ $message }}</span>
			@enderror
		</div>
		<div class="form-group">
			<button type="submit" class="btn-primary btn-block">
				{{ $message }}
			</button>
		</div>
	</div>
</div>