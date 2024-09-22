@extends('layouts.base')
@section('content')
<style>
     .but
        {
            background: #1A5684 !important;
            color: #ffffff;
        }
</style>
<div class="container pt-5 border px-5 py-5  border-dark bg-white">
    <div class="float-right">
    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
        Nouvelle province
      </button>
      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#territoiremodal">
        Nouvelle ville
      </button>
    </div>
	<h5 class="text-center">AJOUTER UNE NOUVELLE ECOLE</h5>
    <form action="{{ route('ecoles.store') }}" method="POST" >
		@csrf
		@method('POST')
	<div class="form-row">
		<div class="form-group col-6">
			<label for="first_name" class="text-dark"><strong>Nom</strong></label>
			<input type="text" class="form-control" id="nom_ecole" name="nom_ecole">
	  </div>
      <div class="form-group col-6">
        <label for="first_name" class="text-dark"><strong>ARRETER MINISTERIEL</strong></label>
        <input type="text" class="form-control" id="arreter_ministeriel" name="arreter_ministeriel">
  </div>
	  <div class="form-group col-6">
		<label for="adresse_ecole" class="text-dark"><strong>ADRESSE</strong></label>
		<input type="text" class="form-control" id="adresse_ecole" name="adresse_ecole">
	  </div>

		<div class="form-group col-6">
			<label for="date_creation" class="text-dark"><strong>DATE CREATION</strong></label>
			<input type="date" class="form-control" id="date_creation" name="date_creation" />
	  </div>
	  <div class="form-group col-6">
		<label for="sexe" class="text-dark"><strong>TYPE ECOLE</strong></label>
		<select class="form-control" name="type_ecole">
            <option value="">--Selectionner--</option>
            <option value="mixte">MIXTE</option>
            <option value="garcon">GARCON</option>
            <option value="fille">FILLE</option>
        </select>
	  </div>
      <div class="form-group col-6">
		<label for="sexe" class="text-dark"><strong>CATEGORIE ECOLE</strong></label>
		<select class="form-control" name="categorie_ecole">
            <option value="">--Selectionner--</option>
            <option value="catholique">CATHOLIQUE</option>
            <option value="protestante">PROTESTANTE</option>
            <option value="islamique">ISLAMIQUE</option>
            <option value="kimbaguiste">KIMBAGUISTE</option>
            <option value="public">PUBLIC</option>
            <option value="privée">PRIVEE</option>
        </select>
	  </div>
      <div class="form-group col-6">
		<label for="sexe" class="text-dark"><strong>NIVEAU</strong></label>
		<select class="form-control" name="niveau_ecole">
            <option value="">--Selectionner--</option>
            <option value="maternel">MATERNEL</option>
            <option value="primaire">PRIMAIRE</option>
            <option value="secondaire">SECONDAIRE</option>
        </select>
	  </div>


		<div class="form-group col-6">
			<label for="vacation" class="text-dark"><strong>VACATION</strong></label>
			<input type="text" class="form-control" id="vacation" name="vacation">
	  </div>

	  <div class="form-group col-6">
		<label for="province_id" class="text-dark"><strong>PROVINCE</strong></label>
		<select class="form-control" id="province_id" name="province_id">
            <option>--Selectionner--</option>
            @foreach ($provinces as $province )
            <option value={{ $province->id }}>{{ $province->nom_province }}</option>
            @endforeach
        </select>
	  </div>
      <div class="form-group col-6">
		<label for="territoire_id" class="text-dark"><strong>TERRITOIRE ou VILLE</strong></label>
		<select class="form-control" id="territoire_id" name="territoire_id">
            <option>--Selectionner--</option>
            @foreach ($territoires as $territoire )
            <option value={{ $territoire->id }}>{{ $territoire->nom_territoire }}</option>
            @endforeach
        </select>
	  </div>

	</div>
	<button type="submit" class="btn btn-primary float-right">Enregistrer</button>
    </form>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">AJOUTER UNE NOUVELLE PROVINCE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('provinces.store')}}" method="POST">
            @csrf
		        @method('POST')
            <div class="form-group">
                <input type="text" class="form-control" name="nom_province" placeholder="Nom de la province"/>
            </div>
            <button type="submit" class="btn btn-primary float-end">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>

     <!-- Modal Pour enregistrer le territoire-->
<div class="modal fade" id="territoiremodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">AJOUTER UN NOUVEAU TERRITOIRE</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('territoires.store')}}" method="POST">
            @csrf
		        @method('POST')
            <div class="form-group">
                <input type="text" class="form-control" name="nom_territoire" placeholder="Nom du territoire"/>
            </div>
            <div class="form-group">
                <label for="nom">Province</label>
                <select class="form-control" id="nom" name="province_id">
                <option>--Selectionner--</option>
                @foreach ($provinces as $province )
                <option value={{ $province->id }}>{{ $province->nom_province }}</option>
                @endforeach
            </select>
            </div>
            <button type="submit" class="btn btn-sm but float-end">Enregistrer</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@stop
