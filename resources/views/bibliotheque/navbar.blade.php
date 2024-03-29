<style type="text/css">
	li.active{
		font-size: 14px;
	}
	ul{
		list-style: none;
	}

	li.active a{
		color: white;
		
	}
</style>

<div class="row">
	<div class="col">
		<ul class="">
			<li class=" {{ setActiveRoute('bibliotheque') }}">
				<a href="{{ route('bibliotheque') }}"><i class=" 	fa fa-adn mr-2"></i>Auteur</a>
			</li>
			<li class=" {{ setActiveRoute('etageres') }}">
				<a href="{{ route('etageres') }}"><i class=" 	fa fa-houzz mr-2"></i>Etagère</a>
			</li>
		</ul>
	</div>

	<div class="col">
		<ul class="">
			<li class=" {{ setActiveRoute('books') }}"><a href="{{ route('books') }}"><i class="fa fa-book mr-2"></i>Livre</a></li>
			<li class=" {{ setActiveRoute('empruts') }}"><a href="{{ route('empruts') }}"><i class="fa fa-outdent mr-2"></i>Emprunt</a></li>
		</ul>
	</div>

	<div class="col">
		<ul class="">
			<li class=" {{ setActiveRoute('classements') }}"><a href="{{ route('classements') }}"> <i class=" 	fa fa-database mr-2"></i> Classement</a></li>
			<li class=" {{ setActiveRoute('retourlivre') }} "><a href="{{ route('retourlivre') }}"><i class="fa fa-mail-reply-all mr-2"></i>Remise des livres</a></li>
		</ul>
	</div>

	<div class="col">
		<ul class="">
			<li class=" {{ setActiveRoute('professeurs') }}"><a href="{{ route('professeurs') }}"><i class=" 	fa fa-user-md mr-2"></i>Professeur</a></li>
			<li class=" {{ setActiveRoute('lecteurs') }}"><a href="{{ route('lecteurs') }}"><i class="fa fa-asterisk mr-2"></i>Lecteur</a></li>
		</ul>
	</div>

	<div class="col">
		<ul class="">
			<li class=" {{ setActiveRoute('history') }}"><a href="{{ route('history') }}"><i class="fa fa-history mr-2"></i>  Historique</a></li>
			<li class=" "><a href="{{ route('history') }}"><i class="fa fa-bar-chart-o mr-2"></i>Statistique</a></li> 
		</ul>
	</div>

</div>
