@extends('layouts.base')

@section('content')
@can('is-admin')
<div class="container pt-5 border px-5 py-5  border-dark bg-white">
    <button class="btn btn-sm text-white float-right" wire:click="$toggle('showDiv')">Nouveau Horaire</button>
    <input type="search" placeholder="Rechercher par le nom" wire:model.live.debounce.300ms="search"/>

    <table class="table table-striped w-100 mt-2">
        <thead>
            <tr>
                <th>Jour</th>
                <th>Heure</th>
                <th>Cours</th>
                {{-- <th>Enseignant</th> --}}
                <th>Classe</th>
                <th>Section</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getHoraire as $horaire)
                <tr>
                    <td>{{ $horaire->jour }}</td>
                    <td>{{ $horaire->heure }}</td>
                    <td>{{ $horaire->cours }}</td>
                    {{-- <td>{{ $horaire->user->name }}</td> --}}
                    <td>{{ $horaire->classe->name }}</td>
                    <td>{{ $horaire->classe->section->name }}</td>
                    <td>
                        <button type="button" data-toggle="modal" data-target="#updatemodal" wire:click.prevent="edit({{ $horaire->id }})" class="btn btn-sm btn-info" ><i class="fa fa-pencil"></i></button>
                        <button type="button" class="btn-sm btn-danger text-white" wire:click="deleteId({{ $horaire->id }})" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash"></i></button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="float-right">
        {{ $getHoraire->links() }}
    </div>

</div>
</div>
  {{-- modal to confirm delete --}}
  <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                     <span aria-hidden="true close-btn">×</span>

                </button>

            </div>

           <div class="modal-body">

                <p>Are you sure want to delete?</p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>

                <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>

            </div>

        </div>

    </div>

</div>
{{-- fin modal confirm --}}

{{-- start update modal --}}
<div>
    <div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="updatemodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="updatemodalLabel">Modification Horaire</h5>
                    <button type="button" class="btn-close bc" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" wire:model='horaire_id'>
                        <div class="form-group">
                            <label for="jour">Durée</label>
                            <input type="text" wire:model="jour" id="jour" placeholder="jour"
                                class="form-control rounded-0" wire:model="eleve_id" />
                        </div>
                        <div class="form-group">
                            <label for="heure">Durée</label>
                            <input type="text" wire:model="heure" id="duree" placeholder="heure"
                                class="form-control rounded-0"  />
                        </div>
                        <div class="form-group">
                            <label for="cours">Cours</label>
                            <input type="text" cours placeholder="cours" id="cours"
                                class="form-control rounded-0" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white"
                        data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end update modal --}}
@endcan
@stop
