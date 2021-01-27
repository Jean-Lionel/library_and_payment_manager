<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="row">
        <div class="col-md-3">
            <select name="" wire:model="selectedSection" id="" class="form-control">
                <option value="">Choisissez une section</option>

                @foreach($sections as $section)

                <option value="{{ $section->id }}">{{ $section->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <div class="form-group">

                <select name="" wire:model="selectedClasse" id="" class="form-control">
                    <option value="">Choisissez une classe</option>

                    @foreach($classes as $classe)

                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">

        	<select wire:model="type_paiement" id="" class="form-control">
        		<option value="">Choisissez ...</option>
        		<option value="PAYE">Ceux qui ont payé</option>
        		<option value="NON PAYE">Ceux qui n'ont pas payé</option>
        		
        	</select>
        </div>
        <div class="col-md-3">
            <input type="text" wire:model="searchKey" placeholder="Rechercher ici " class="form-control">
        </div>


    </div>

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
                </div>

                <div>
                
                    <span>{{ date('d/m/Y')}}</span>
             </div>

         </header>


         <div>
            <h5 id="title"><u>LISTE DE CEUX QUI N'ONT PAS ENCORE PAYE LE MINERVALE </u></h5>

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

                </tr>

                @endforeach
            </tbody>
        </table>

    </div>

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
