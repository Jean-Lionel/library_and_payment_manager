<style>
	.header ul li{
		display: inline-block;
	}
</style>

<div class="header">
	<ul>
		@canany(['is-admin','is-prefet'])
		<li class=" {{ setActiveRoute('sections.index') }} text-info">
			<a href="{{ route('sections.index') }}"><span class="fa fa-home mr-3 text-black"></span> Section</a>
		</li>
		@endcanany
		@canany(['is-admin','is-prefet'])
		<li class=" {{ setActiveRoute('level.index') }} text-light">
			<a href="{{ route('level.index') }}"><span class="fa fa-home mr-3 text-black"></span> Niveau</a>
		</li>
		@endcanany
		@canany(['is-admin','is-prefet'])
		<li class=" {{ setActiveRoute('classes.index') }} text-light">
			<a href="{{ route('classes.index') }}"><span class="fa fa-home mr-3 text-black"></span> Classes</a>
		</li>
		@endcanany

		@canany(['is-admin','is-prefet'])
		<li class=" {{ setActiveRoute('presences.index') }} text-light">
			<a href="{{ route('presences.index') }}"><span class="fa fa-home mr-3 text-black"></span> Liste des presence</a>
		</li>
		@endcanany


	</ul>

</div>
