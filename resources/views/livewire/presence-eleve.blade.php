<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}


    <style>
        .but
        {
            background: #1A5684;
            color: #ffffff;
        }
    </style>
    <div class="container align-items-center justify-content-center">
        <div class="col-md-12">
            <h2 class="text-center ">LISTE DE PRESENCE DU {{now()->format('d-m-Y')}}</h2>
            <select wire:model='by_classe' id="by_classe" class="form-control rounded-0">
                <option value="0">--Selectionner--</option>
                @foreach ($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->name .' '.$classe->section->name }}</option>
                @endforeach

            </select>
            <table class="table table-striped">
                <thead class="but">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Status</th>
                        <th>Classe</th>
                        <th>Section</th>
                        <th>Jour</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{$i = 1 }}
                    @foreach ($listePresence as $presence)
                    <tr>
                        <td>{{ $i ++ }}</td>
                        <td><img src="{{ asset('uploads/eleve/' .$presence->eleve->image_eleve) }}" alt="image" style="width: 44px; height: 44px; border-radius: 100%;"/></td>
                        <td>{{ $presence->eleve->first_name }}</td>
                        <td>{{ $presence->eleve->last_name }}</td>
                        <td>
                            {{$presence->status_presence == 1 ? 'P' : 'A'}}
                        </td>
                        <td>{{$presence->classe->name}}</td>
                        <td>{{$presence->classe->section->name}}</td>
                        <td>{{date('d-m-Y', strtotime($presence->created_at));}}</td>
                        <td>
                            <button class="btn btn-sm btn-info"><i class="fa fa-eye text-white"></i></button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

