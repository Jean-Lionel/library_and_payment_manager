
<style>
	table{
		border-collapse: collapse;
		width: 100%;
	}
	tr,td,th,table{
		border: 1px solid black;
	}
	td{
		text-align: right;
	}
	.text-left{
		text-align: left;
	}
	.header-left{
		float: left;
	}
	.header-left p{
		line-height: 0.5;
	}
	.text-center{
		text-align: center;
	}
	.header-right{
		float: right;
	}

</style>

<div>

	<div class="header">
		<div class="header-left">
			<p><b>NOM DE L'ETABLIMSSEMENT </b></p>
			<p><b>ANNEE SCOLAIRE : 2021-2022</b></p>
		</div>
		<div class="header-right">
			<p>Le {{ date('d-m-Y') }}</p>
		</div>
	</div>

	<div style="clear: both;"></div>

	<div>
		<h4 class="text-center">Effectif des élèves par sexe</h4>
		<table class="table">
			<thead>
				<tr>
					<th>No</th>
					<th>Classe</th>
					<th>F</th>
					<th>%F</th>
					<th>G</th>
					<th>%G</th>
					<th>T(G + H)</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($classes as $element)
				{{-- expr --}}
				<tr>
					<td>{{ $loop->index +1 }}</td>
					<td>{{ $element['name'] }}</td>
					<td>{{ $element['f'] }}</td>
					<td>{{ $element['p_f'] }}</td>
					<td>{{ $element['g'] }}</td>
					<td>{{ $element['p_g'] }}</td>
					<td>{{ $element['total']  }}</td>
				</tr>
				@endforeach

				<tr>
					<th colspan="2">Total</th>
					<th>{{ sumColumn($classes, 'f') }}</th>
					<th>{{ getPourcentage(sumColumn($classes, 'f'),sumColumn($classes, 'total') )  }}</th>
					<th>{{ sumColumn($classes, 'g') }}</th>
					<th>{{ getPourcentage(sumColumn($classes, 'g'),sumColumn($classes, 'total') )  }}</th>
					<th>{{ sumColumn($classes, 'total') }}</th>
					

				</tbody>
			</table>
			<hr>
			<h4 class="text-center">Effectif des élèves par sexe et par niveau d'étude</h4>

			<table class="">
				<thead>
					<thead>
						<tr>
							<th>No</th>
							<th>Niveau</th>
							<th>F</th>
							<th>%F</th>
							<th>G</th>
							<th>%G</th>
							<th>T(G + H)</th>
						</tr>
					</thead>
				</thead>
				<tbody>
					@foreach ($levels as $element)
					{{-- expr --}}
					<tr>
						<td>{{ $loop->index +1 }}</td>
						<td>{{ $element['name'] }}</td>
						<td>{{ $element['f'] }}</td>
						<td>{{ $element['p_f'] }}</td>
						<td>{{ $element['g'] }}</td>
						<td>{{ $element['p_g'] }}</td>
						<td>{{ $element['total']  }}</td>
					</tr>
					@endforeach

					<tr>
						<th colspan="2">Total</th>
						<th>{{ sumColumn($levels, 'f') }}</th>
						<th>{{ getPourcentage(sumColumn($levels, 'f'),sumColumn($classes, 'total') )  }}</th>
						<th>{{ sumColumn($levels, 'g') }}</th>
						<th>{{ getPourcentage(sumColumn($levels, 'g'),sumColumn($classes, 'total') )  }}</th>
						<th>{{ sumColumn($levels, 'total') }}</th>

					</tr>

				</tbody>
			</table>
		</div>
	</div>