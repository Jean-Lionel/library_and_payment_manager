<style>
	.header ul li{
		display: inline-block;
	}
</style>

<div class="header">
	<ul>
		@canany(['is-admin','is-prefet'])
		<li class=" {{ setActiveRoute('sections.index') }} text-light">
			<a href="{{ route('sections.index') }}"><span class="fa fa-home mr-3 text-light"></span> Section</a>
		</li>
		@endcanany
		@canany(['is-admin','is-prefet'])
		<li class=" {{ setActiveRoute('level.index') }} text-light">
			<a href="{{ route('level.index') }}"><span class="fa fa-home mr-3 text-light"></span> Niveau</a>
		</li>
		@endcanany
	</ul>
	
</div>