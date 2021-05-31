<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <p>
    	<input type="text" class="input" wire:model.debounce.500ms="search">
    	<span class="icon is-small is-left"></span>
    </p>
    <table class="table table-sm">
    	<thead>
    		<tr>
    			<th>Numéro</th>
    			<th wire:click="setOrderBy('first_name')">Nom</th>
    			<th wire:click="setOrderBy('last_name')">Prénom</th>
    		</tr>
    		
    	</thead>

    	<tbody>
    		 @foreach ($eleves as $element)
    	{{-- expr --}}
    		<tr>
    			<td>{{$element->compte->name}}</td>
    			<td>{{$element->first_name}}</td>
    			<td>{{$element->last_name}}</td>
    			<td>
    				<button wire:click="startId({{$element->id}})">Edit</button>
    			</td>
    		</tr>

    			@if ($element->id == $editId)
    				{{-- expr --}}
    				<tr>
    					<td colspan="5"> EDIT</td>
    				</tr>
    			@endif
   			 @endforeach
    	</tbody>
    </table>

    {{$eleves->links()}}
</div>
