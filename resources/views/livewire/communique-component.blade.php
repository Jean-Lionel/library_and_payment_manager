<div>
    <div class="container">
        <h3 class="text-center text-uppercase">Nouveau communiquer</h3>
        <p>
            Le communiquer que vous allez ecrire, sera vu par tous les parents qui ont aumoins un élève inscrit dans votre établissement
        </p>
        <form wire:submit.prevent="saveCommuniquer">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="titre"><strong>Titre</strong></label>
                    <textarea wire:model="titre" id="titre" class="form-control rounded-0" cols="30" rows="3"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="message"><strong>Message</strong></label>
                    <textarea wire:model="message" id="message" class="form-control rounded-0" cols="30" rows="10"></textarea>
                </div>
            </div>
            <button class="btn btn-sm btn-primary w-100">Envoyer</button>
        </form>
    </div>

    <div class="tabledata mt-3 card--container">
        <table class="table table-bordered table-sm ">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($communiques as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $value->titre }}</td>
                    <td>{{$value->message}}</td>
                    <td>{{$value->created_at}}</td>
                    <td>
                        <button class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div>
            {{ $communiques->links() }}
        </div>


    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>

</div>
