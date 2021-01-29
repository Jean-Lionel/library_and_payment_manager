
<style type="text/css">
	li.active{
		font-size: 18px;
		
		
	}

	li.active a{
		color: white;
		
	}
</style>

<div class="row">
	<div class="col">
		<ul class="list-inline">
			<li class="list-group-item {{ setActiveRoute('bibliotheque') }}"><a href="{{ route('bibliotheque') }}">Auteur</a></li>
			<li class="list-group-item {{ setActiveRoute('etageres') }}"><a href="{{ route('etageres') }}">Etagere</a></li>
		</ul>
	</div>

	<div class="col">
		<ul class="list-inline">
			<li class="list-group-item {{ setActiveRoute('books') }}"><a href="{{ route('books') }}">Livre</a></li>
			<li class="list-group-item {{ setActiveRoute('empruts') }}"><a href="{{ route('empruts') }}">Emprunt</a></li>
		</ul>
	</div>

	<div class="col">
		<ul class="list-inline">
			<li class="list-group-item {{ setActiveRoute('classements') }}"><a href="{{ route('classements') }}">Classement</a></li>
			<li class="list-group-item {{ setActiveRoute('etageres') }}"><a href="{{ route('etageres') }}">Etagere</a></li>
		</ul>
	</div>


	<div class="col">
		<ul class="list-inline">
			<li class="list-group-item {{ setActiveRoute('professeurs') }}"><a href="{{ route('professeurs') }}">Professeur</a></li>
			<li class="list-group-item {{ setActiveRoute('lecteurs') }}"><a href="{{ route('lecteurs') }}">Lecteur</a></li>
		</ul>
	</div>

</div>
