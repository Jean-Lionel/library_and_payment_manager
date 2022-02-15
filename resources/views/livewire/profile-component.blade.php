<div>
    {{-- Stop trying to control. --}}
    
    <div class="card" style="width: 25rem;">
      <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between">
            <span> Nom et prénom :</span>
            <span><b>{{ $user->name}}</b></span>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            Téléphone : <b>{{$parent->telephone}}</b>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            Email : <b>{{ $user->email}}</b>
        </li>
        <li class="list-group-item d-flex justify-content-between">
            <button class="btn btn-link text-center" >
            Modifier le mot de passe</button>
        </li>

        <li class="list-group-item ">
            <div class="form-group">
                <label for="">Ancien mot de passe</label>
                <input type="password" wire:model="oldPassword" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <label for="">Nouveau mot de passe</label>
                <input type="password" wire:model="currentPassword" class="form-control form-control-sm">
            </div> 
            <div class="form-group">
                <label for="">Rettapez votre mot de passe</label>
                <input type="password" wire:model="newPassword" class="form-control form-control-sm">
            </div>
            <div class="form-group">
                <button class="btn-info btn-sm btn-block" wire:click="updatePassword">Enregitrer</button>
            </div>
        </li>
    </ul>
</div>
</div>
