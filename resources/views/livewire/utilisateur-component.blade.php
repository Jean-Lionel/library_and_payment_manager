<div>
    {{-- Do your work, then step back. --}}
    <h4 class="text-center">Liste des Utilisateurs</h4>

    <style>
        .inputs{
            display: inline-block;
            margin-right: 10px;
        }
        img
        {
            width: 50px;
            height: 50px;
            cursor: pointer;
            border-radius: 50%;
        }

        .but
        {
            background: #1A5684;
            color: #ffffff;
        }
        .but:hover
        {
            color: #ffffff
        }
    </style>

    @if($showForm)
    <div class="container pt-5 border px-5 py-5  border-dark bg-white mt-4">
        <div class="row">
            <form action="" wire:submit.prevent="saveUser" enctype="multipart/form-data">
            <div class="form-row">
             <div class="form-group col-md-4">
                <label for="">NOM ET PRENOM</label>
                <input type="text" wire:model="name" class="form-control rounded-0">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
             <div class="form-group col-md-4">
                <label for="email">EMAIL</label>
                <input id="email" type="email" placeholder="ex : dieudonne@gmail.com" wire:model="email" class="form-control rounded-0">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>
            <div class="form-group col-md-4">
                <label for="">TELEPHONE</label>
                <input type="text" placeholder="ex : +257 79 614 036" wire:model="telephone" class="form-control rounded-0">
                @error('telephone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="">ECOLE</label>
                <select type="text" wire:model="ecole_id" class="form-control rounded-0">
                    @foreach ($ecoles as $ecole)
                    <option value={{ $ecole->id }}>{{$ecole->nom_ecole}}</option>
                    @endforeach
                </select>
                @error('ecole')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group col-md-4">
                <label for="email">Photo</label>
                <input id="image_user" type="file"  wire:model="image_user" class="form-control rounded-0">
                @error('image_user')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="">MOT DE PASSE</label>
                <input type="password" placeholder="" wire:model="password" class="form-control rounded-0">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

             <div class="form-group col-md-4">
                <label for="">RETAPEZ VOTRE MOT DE PASSE</label>
                <input type="password" placeholder="" wire:model="password_confirmation" class="form-control rounded-0">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <button class="btn but float-right mt-3">Enregistrer</button>
            </form>

        </div>
    </div>

    @else
    <div class="text-right">
        <div class="row">
            <div class="col-md-6">
                <input type="text" wire:model="search" class="form-control" placeholder="Recherche">
            </div>
             <div class="col-md-6 float-end">
                 <button wire:click="$set('showForm', {{! $showForm}})" class="btn but  btn-sm" title="Nouvel Utilisateur"><i class="fa fa-plus"></i></button>
            </div>
        </div>

    </div>
    <table class="table table-sm table-striped bg-white mt-4">
        <thead class="but text-white">
            <tr>
                <th>Photo</th>
                <th>NOM ET PRENOM</th>
                <th>EMAIL</th>
                <th>ROLES</th>
                <th>ACTION</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($users  as $user)
                {{-- expr --}}

                <tr>
                    <td><img src="{{ asset('../uploads/user' . $user->image_user) }}" alt=""></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <ul>
                            @foreach ($user->roles  as $r)
                                {{-- expr --}}
                                <li>{{ $r->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                       <button wire:click="editeUser({{$user->id}})" title="Modifier">
                            <i class="fa fa-edit"></i>
                       </button>
                       <button wire:click="addRoles({{$user->id}})" title="Add Role">
                            <i class="fa fa-plus"></i>
                       </button>
                    </td>
                </tr>
                @if($editId == $user->id)
                <tr>
                    <td colspan="3">
                    @if($addRoleToUser)
                       @foreach ($roles as $role)
                        {{-- expr --}}
                        <input   type="checkbox"
                        value="{{$role->id}}"
                        wire:model="choosedroles.{{$role->name}}"
                         id="{{$role->id}}">

                        <label class="inputs"  for="{{$role->id}}">{{$role->name}}</label>
                        @endforeach
                        <button wire:click="validerRule">Valider</button>
                    @endif

                    </td>
                    <td>

                    </td>
                </tr>

                @endif
            @endforeach

        </tbody>
    </table>

    @endif


</div>
