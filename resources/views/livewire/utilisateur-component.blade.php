<div>
    {{-- Do your work, then step back. --}}
    <h4>Liste des Utilisateurs</h4>

    <style>
        .inputs{
            display: inline-block;
            margin-right: 10px;
        }
    </style>

    @if($showForm)
    <div class="row">
        <div class="offset-3 col-md-5">
            <form action="" wire:submit.prevent="saveUser">
                            <div class="form-group">
                <label for="">NOM ET PRENOM</label>
                <input type="text" wire:model="name" class="form-control">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
             <div class="form-group">
                <label for="email">EMAIL</label>
                <input id="email" type="email" placeholder="ex : nijeanlionel@gmail.com" wire:model="email" class="form-control">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>
            <div class="form-group">
                <label for="">TELEPHONE</label>
                <input type="text" placeholder="ex : +257 79 614 036" wire:model="telephone" class="form-control">
                @error('telephone')
                <span class="text-danger">{{$message}}</span>
                @enderror

            </div>


            <div class="form-group">
                <label for="">MOT DE PASSE</label>
                <input type="password" placeholder="" wire:model="password" class="form-control">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

             <div class="form-group">
                <label for="">RETAPEZ VOTRE MOT DE PASSE</label>
                <input type="password" placeholder="" wire:model="password_confirmation" class="form-control">
                @error('password')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Enregistrer</button>
            </div>
            </form>
            
        </div>
    </div>

    @else
    <div class="text-right">
        <button wire:click="$set('showForm', {{! $showForm}})" class="btn btn-primary btn-sm" title="Nouvel Utilisateur"><i class="fa fa-plus"></i></button>
    </div>
    <table class="table table-sm">
        <thead>
            <tr>
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
