
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

			</tbody>
		</table>

		<hr>
		<h4 class="text-center">Effectif des élèves par sexe et par niveau d'étude</h4>
	</div>
</div>