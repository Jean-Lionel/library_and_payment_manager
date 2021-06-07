<div>
    {{-- The best athlete wants his opponent at his best. --}}

    <p>
    	<input type="text" class="input" wire:model.debounce.500ms="search">
    	<span class="icon is-small is-left"></span>

        <button id="telecharger"> Télécharger le model <i class="fa fa-download"></i></button>
        <input type="file"  id="file_doc"  accept=".csv">
        <button id="save_btn">Charger les données<i class="fa fa-upload"></i></button>
    </p>
    <h4> Classe :  {{ $evaluation->classe->name}}</h4>
    <table class="table table-sm">
    	<thead>
    		<tr>
    			<th>Numéro</th>
                <th>COURS</th>
    			<th wire:click="setOrderBy('first_name')">Nom 
                    <i class="fa fa-arrow-down"></i>
                    <i class="fa fa-arrow-up"></i></th>
    			<th wire:click="setOrderBy('last_name')">Prénom 
                    <i class="fa fa-arrow-down"></i>
                    <i class="fa fa-arrow-up"></i></th>
                <th> POINT OBTENU / {{ $evaluation->ponderation }}</th>
    		</tr>
    	</thead>
    	<tbody>
    		 @foreach ($eleves as $element)
    	{{-- expr --}}
    		<tr>

    			<td>{{$element->compte->name}}</td>
                <td>{{$evaluation->cour->name}}</td>
    			<td>{{$element->first_name}}</td>
    			<td>{{$element->last_name}}</td>
                
                <td>{{ $element->point_obentu_evaluation($evaluation->id)->point_obtenu }}</td>
    			<td>
    			<button wire:click="startId({{$element->id}})">Edit</button>
    			</td>
    		</tr>
    			@if ($element->id == $editId)
    				{{-- expr --}}
    				<tr>
    					<td colspan="6"> 
                            <form wire:submit.prevent="savePoint">
                                <div class="form-group offset-9 col-md-3">
                                    <input type="text" wire:model="point_obentu" class="form-control ">

                                    @error('point_obentu')
                                    <span class="error text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-primary"> &#x1f197; </button> 
                                        <button class="btn btn-danger" wire:click.prevent="closeForm"> &#x1f512; </button>
                                    </div> 
                                </div>
                                
                            </form>
                        </td>
    				</tr>
    			@endif
   			 @endforeach
    	</tbody>
    </table>
    {{$eleves->links()}}
</div>
@push("scripts")
<script> 
    const evaluation_id = "{{ $evaluation->id }}"

    let list_points = []
    const a = document.getElementById("telecharger")
    a.addEventListener('click', function(e){
        e.preventDefault();

        let info_s = @json($info);
        let classe_name = info_s.classe_name +"_cour_"+info_s.cour_name
                                +"_date_"+info_s.date_evaluation;
        let tout_eleves = @json($tout_eleves);
        let csvContent = "data:text/csv;charset=utf-8,";

        let datas = [['CLASSE','NUMERO', 'NOM','PRENOM','POINT']]

        tout_eleves.forEach((eleve) =>{
            //console.log(eleve)
            datas.push([info_s.classe_name,eleve.id, eleve.first_name, eleve.last_name],)
         });

        datas.forEach((rowArray) =>{
            let row = rowArray.join(",");
            csvContent += row + "\r\n";
        });
        var encodedUri = encodeURI(csvContent);
        var link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "evaluation_"+classe_name+".csv");
        document.body.appendChild(link); // Required for FF
        link.click(); // This will download the data file named "my_data.csv".

    })

    let file_doc = document.getElementById("file_doc")

    file_doc.addEventListener("change", function(e){

        e.preventDefault()
        const fileList = event.target.files[0];
        
        readFile(fileList);
    })

    function readFile(file){
        const reader = new FileReader()

        reader.addEventListener('load',function(e){
            const result = e.target.result
            const data = result.split('\r\n')

            const headers = data[0].split(',')

            for(let i = 1; i<data.length; i++){
                let line = data[i].split(',')
                list_points.push({
                    evaluation_id : evaluation_id,
                    eleve_id  : line[1],
                    point_obtenu : line[4],

                });

            }
            
        })
        reader.readAsText(file,'UTF-8');
    }

    const save_btn = document.getElementById("save_btn")

    save_btn.addEventListener("click", function(e){
        e.preventDefault() 
        console.log(list_points)

        @this.testExemple(list_points)

    })
</script>



@endpush
