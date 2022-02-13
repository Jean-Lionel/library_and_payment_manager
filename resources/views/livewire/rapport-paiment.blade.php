<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-md-3">
            <label for="">SECTION</label>
            <select name="" wire:model="selectedSection" id="" class="form-control form-control-sm">
                
                <option value="">Choisissez une section</option>

                @foreach($sections as $section)

                <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for=""> CLASSE </label>

                <select name="" wire:model="selectedClasse" id="" class="form-control form-control-sm">
                    <option value="">Choisissez une classe</option>

                    @foreach($classes as $classe)

                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <label for="">CATEGORIE</label>

        	<select wire:model="type_paiement" id="" class="form-control form-control-sm">
        		<option value="">Choisissez ...</option>
        		<option value="PAYE">Ceux qui ont payé</option>
        		<option value="NON PAYE">Ceux qui n'ont pas payé</option>
        	</select>
        </div>

          <div class="col-md-3">
            <label for="">TYPE DE PAIMENENT</label>

            <select wire:model="category_paiement" id="" 
            class="form-control form-control-sm">
                <option value="MINERVAL" >MINERVAL</option>
                <option value="CONTRIBUTION" selected="">CONTRIBUTION</option>
               
            </select>
        </div>


        <div class="col-md-3">
            <label for="">Année scolaire</label>
             <select wire:model="annee_scolaire" name="" id="" class="form-control form-control-sm">

                @forelse ($anneScolaire as $key => $anne)
                 <option value="{{ $anne->name }}" @if($key == 0) selected @endif >{{$anne->name}}</option>
                @empty
                    <option value="">EMPTY</option>
                @endforelse
            </select>
        </div>


        <div class="col-md-3">
            <label for="">TRIMESTRE</label>

            <select name="" wire:model="trimestre" id="" 
            class="form-control form-control-sm">
                
                <option value="PREMIER TRIMESTRE">I ère TRIMESTRE</option>
                <option value="DEUXIEME TRIMESTRE">II ère TRIMESTRE</option>
                <option value="TROISIEME TRIMESTRE">III ère TRIMESTRE</option>
            </select>
            
        </div>
        <div class="col-md-3">
            <label for="">Minimum</label>
            <input type="text" class="form-control form-control-sm" wire:model="minMontant">
        </div>
      
        <div class="col-md-3">
            <label for="">Rechercher </label>

            <input type="text" wire:model="searchKey" placeholder="Rechercher ici " class="form-control form-control-sm">
        </div>


    </div>

    @if($eleves->count() > 0)
    <div> <button onclick="clickButton()">Imprimer</button></div>
<div id="impression">

    <!DOCTYPE html>
    <head>

        <style>

            header{
                display: flex;
                justify-content: space-between;
            }

            table{
                width: 100%;
                border-collapse: collapse;
            }

            table, tr, td,th{
                border: 1px solid black;
            }

            #title{
                text-align: center;
            }
            body{
                padding: 0;
                margin: 0;
                font-size: 14px;
            }

        </style>
    </head>
    <body>

        <div>
            <header>
                <div >

                    <h5>LYCEE DU SAINT ESPRIT</h5>
                    <h5>DPE : BUJUMBURA</h5>
                    <h5>A/S : {{ $annee_scolaire}}</h5>
                </div>

                <div>
                
                    <span>{{ date('d/m/Y')}}</span>
             </div>

         </header>


         <div>
            <h5 id="title"><u>LISTE DE PAIE </u></h5>

            <div>
                <table>
                  <thead>
                    <tr>
                        <th>Numéro</th>
                        <th>Classe</th>
                        <th>Nom et prénom</th>
                        <th>Montant</th>

                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($eleves as $key =>$paiement)
                  <tr>
                    <td>{{ ++$key}}</td>

                    <td>{{ $classe->getClasseById($paiement->classe_id)->name}}</td>
                    <td>{{ strtoupper($paiement->first_name)  .'  '. 
                ucwords(strtolower($paiement->last_name)) }}</td>
                    <td>{{ $paiement->amount }}</td>
                    <td></td>

                </tr>

                @endforeach
            </tbody>
        </table>

    </div>

    @endif

</div>



@push('scripts')
<script type="text/javascript">             

function clickButton(){
        printJS({
            printable: 'impression',
            css : "",
            type : 'html',
            header : ""
        });
}
</script>

@endpush
