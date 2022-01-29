
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
	@dump($data)

	@foreach ($data['palmares'] as $element)
		{{-- expr --}}
	<table>
		<thead>
			<tr>
				<th>Nom et Prénom : </th>
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
	</table>

	@endforeach
</div>