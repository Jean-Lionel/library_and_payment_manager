
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
				<p><b>CLASSE : </b></p>
				<p><b>BRANCHE : </b></p>
				<p><b>ANNEE SCOLAIRE : </b></p>
			</div>
			<div class="header-right">
				<p>Le {{ date('d-m-Y') }}</p>
			</div>
	</div>

	<div style="clear: both;"></div>
	
	<div>
		<h5 class="text-center"><u>PALMARES DES RESULTATS</u></h5>

		<table>
			<thead>
				<tr>
					<th>Place</th>
					<th>Nom et prénom</th>
					<th>Sexe</th>
					<th>Totat des points obtenus</th>
					<th>%</th>
					<th>Echecs</th>
					<th>Décision du jury</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($palmares as $eleve)
					{{-- expr --}}
					<tr>
						<td>{{ ++$loop->index }}</td>
						<td>{{ $eleve->fullName }}</td>
						<td>{{ $eleve->sexe }}</td>
						<td>{{ $eleve->points }}</td>
						<td>{{ $eleve->poucentage }}</td>
						<td></td>
					</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
</div>