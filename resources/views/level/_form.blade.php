<div>
	<div class="col-md-4 ofset-md-4">
		<div class="form-group">
			<label for="">Niveau</label>
			<input class="form-control" value="{{ old('name') ?? $level->name ?? '' }}" type="text" name="name">
			@error('name')
			<span class="text-danger text-center">{{ $message }}</span>
			@enderror
		</div>
		<div class="form-group">

			<label for="section_id">Section</label>
			<select class="form-control" required 
			name="section_id" id="" >
				<option value=""></option>
				@foreach ($sections as $element)
				<option value="{{ $element->id }}"
					@if (isset($level) and ($level->id == $element->id) )
						{{-- expr --}}
						selected 
					@endif

					>{{  $element->name }}</option>
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