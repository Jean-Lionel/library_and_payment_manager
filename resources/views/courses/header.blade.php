<style>
.course_header{
	background: #FFF;
}
.course_header a{
	display: inline-block;
	padding-left: 25px;
	font-size: 1.2rem;
}
	
</style>

<div class="course_header">
	
	<a class=" {{ setActiveRoute('cours.index') }}"  href="{{ route('cours.index') }}"><i class="fa fa-plus"></i> Cours</a>
	<a class=" {{ setActiveRoute('evaluations') }}" href="{{ route('evaluations') }}">Evaluation</a>
	@canany(['is-admin','is-prefet'])
	<a class=" {{ setActiveRoute('course_categories') }}" href="{{ route('course_categories') }}">Catégorie</a>
	@endcanany
	<a class=" {{ setActiveRoute('notes') }}" href="{{ route('notes') }}">Notes</a>

	<a class=" {{ setActiveRoute('bullettin') }}" href="{{ route('bullettin') }}">Bullettin</a>
	<a class=" {{ setActiveRoute('palmares') }}" href="{{ route('palmares') }}">Palmarès</a>
	@canany(['is-admin','is-prefet'])
	<a class="{{ setActiveRoute('professeurs') }}" href="{{ route('professeurs') }}"><i class=" 	fa fa-user-md mr-2"></i>Professeur</a>
	@endcanany
</div>