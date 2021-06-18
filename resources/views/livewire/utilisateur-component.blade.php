<div>
    {{-- Do your work, then step back. --}}
    <h4>Liste des Utilisateurs</h4>

    @if($showForm)
    <div class="row">
        <div class="offset-3 col-md-5">
            <form action="" wire:submit.prevent="saveUser">
                            <div class="form-group">
                <label for="">NOM ET PRENOM</label>
                <input type="text" wire:model="name" class="form-control">
                @error('name')
                <span class="text-danger">{{$name}}</span>
                @enderror
            </div>
             <div class="form-group">
                <label for="">EMAIL</label>
                <input type="text" placeholder="ex : nijeanlionel@gmail.com" wire:model="email" class="form-control">
                @error('email')
                <span class="text-danger">{{$name}}</span>
                @enderror

            </div>
            <div class="form-group">
                <label for="">MOT DE PASSE</label>
                <input type="password" placeholder="" wire:model="email" class="form-control">
                @error('password')
                <span class="text-danger">{{$name}}</span>
                @enderror
            </div>

             <div class="form-group">
                <label for="">RETAPEZ VOTRE MOT DE PASSE</label>
                <input type="password" placeholder="" wire:model="email" class="form-control">
                @error('password')
                <span class="text-danger">{{$name}}</span>
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
            </tr>
            
        </thead>

        <tbody>
            
        </tbody>
    </table>

    @endif
</div>
