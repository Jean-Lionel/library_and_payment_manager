<div>
	<div class="row">
			<div>
				<label for="">Année Scolaire</label>
				<select name="anne_scolaire_id" id="annee_scolaire">
					@foreach ($annee_scolaires as $annee_scolaire)
						<option value="{{  $annee_scolaire->id }}">{{ $annee_scolaire->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="row col-md-12">
			@foreach ($sections as $section)

				<div class="col-md-6">
					<h5 class="bg-info">{{ $section->name }}</h5>
					<div >

						@foreach($section->classes as $classe)
						<a href="{{ route('bulletin_generate',['id' => $classe->id , 'x' =>  $anne_scolaire_id]) }}" class="d-block">
							{{ $classe->name }}
						</a>

						@endforeach
					</div>
				</div>
			@endforeach

			</div>
	</div>

		
</div>