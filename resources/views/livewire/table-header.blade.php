<th wire:click="setOrderBy({{$name}})">
	{{$label}}

	@if($visible)

		@if($direction == 'ASC')
			<span>ASC</span>
		@else
		    <span>DESC</span>
		@endif
	@endif
</th>