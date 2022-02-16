<div>
    {{-- Stop trying to control. --}}

      <div>
        @if (session()->has('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif
        @if (session()->has('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

    </div>
    
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
            <button class="btn btn-link text-center" wire:click="$set('showForm',{{!$showForm}})" >
            Modifier le mot de passe</button>
        </li>

        @if ($showForm)
            {{-- expr --}}
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
        @endif

     
    </ul>
</div>
</div>
