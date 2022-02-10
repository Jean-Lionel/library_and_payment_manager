<div>
	<div class="row">
			<div>
				<label for="">Année Scolaire</label>
				<select name="anne_scolaire_id" wire:model="anne_scolaire_id" id="annee_scolaire">
					@foreach ($annee_scolaires as $annee_scolaire)
						<option value="{{  $annee_scolaire->id }}">{{ $annee_scolaire->name }}</option>
					@endforeach
				</select>

				<label for="trimestre">Trimestre</label>
				<select name="trimestre_id" wire:model="trimestre_id" id="trimestre">
					@foreach ($trimestres as $element)
						{{-- expr --}}
						<option value="{{ $element->id }}">{{ $element->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="row col-md-12">
			@foreach ($sections as $section)

				<div class="col-md-6">
					<h5 class="bg-info">{{ $section->name }}</h5>
					<div >

						@foreach($section->classes as $classe)
						<a href="{{ route('bulletin_generate',
						['id' => $classe->id , 
						'x' =>  $anne_scolaire_id,
						't' => $trimestre_id
						]) }}" class="d-block">
							{{ $classe->name }}
						</a>

						@endforeach
					</div>
				</div>
			@endforeach

			</div>
	</div>

		
</div>