<style type="text/css">
  .test-element {
   /* color: #9ca1b2;*/ /*  2b2d3c */
   background: #2a2c3b; /* 2f3242  */
   /* overflow-x: hidden; */
   color: #FFF;
 }
 body,
 html {
  height: 100%;
}
/* workaround modal-open padding issue */
body.modal-open {
  padding-right: 0 !important;
}

#sidebar {
  padding-left: 0;
}
    /*
 * Off Canvas at medium breakpoint
 * --------------------------------------------------
 */
 
 @media screen and (max-width: 48em) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.25s ease-out;
    -moz-transition: all 0.25s ease-out;
    transition: all 0.25s ease-out;
  }
  .row-offcanvas-left .sidebar-offcanvas {
    left: -33%;
  }
  .row-offcanvas-left.active {
    left: 33%;
    margin-left: -6px;
  }
  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 33%;
    height: 100%;
  }
}
    /*
 * Off Canvas wider at sm breakpoint
 * --------------------------------------------------
 */
 
 @media screen and (max-width: 34em) {
  .row-offcanvas-left .sidebar-offcanvas {
    left: -45%;
  }
  .row-offcanvas-left.active {
    left: 45%;
    margin-left: -6px;
  }
  .sidebar-offcanvas {
    width: 45%;
  }
}

.card {
  overflow: hidden;
}

.card-block .rotate {
  z-index: 8;
  float: right;
  height: 100%;
}

.card-block .rotate i {
  color: rgba(20, 20, 20, 0.15);
  position: absolute;
  left: 0;
  left: auto;
  right: -10px;
  bottom: 0;
  display: block;
  -webkit-transform: rotate(-44deg);
  -moz-transform: rotate(-44deg);
  -o-transform: rotate(-44deg);
  -ms-transform: rotate(-44deg);
  transform: rotate(-44deg);
}
</style>

<div class="">
  <div class="alert alert-warning fade collapse" role="alert" id="myAlert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
      <span class="sr-only">Close</span>
    </button>
  </div>

  <div class="div">
    <a href="{{ route('paiements.create') }}">Rapport des paimements par classe</a>
  </div>

  <div class="row mb-3 text-center">
    <div class="col-xl-3 col-lg-6">
      <div class="card card-inverse card-success">
        <div class="card-block bg-success">
          <div class="rotate">
            <i class="fa fa-dollar fa-5x"></i>
          </div>
          <h6 class="text-uppercase">MINERVAL</h6>

          <h5>{{ getPrice($minerval) }}</h5>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card card-inverse card-danger">
        <div class="card-block bg-danger">
          <div class="rotate">
            <i class="fa fa-list fa-4x"></i>
          </div>
          <h6 class="text-uppercase">  CONTRIBUTION </h6>
          <h5>{{ getPrice($contribution) }}</h5>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card card-inverse card-info">
        <div class="card-block bg-info">
          <div class="rotate">
            <i class="fa fa-shopping-cart fa-5x"></i>
          </div>
          <h6 class="text-uppercase">VENTE</h6>
          <h6>{{ getPrice($vente) }}</h6>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-lg-6">
      <div class="card card-inverse card-warning">
        <div class="card-block bg-warning">
          <div class="rotate">
            <i class="fa fa-share fa-5x"></i>
          </div>
          <h6 class="text-uppercase">MONTANT TOTAL</h6>

          <h5>{{ getPrice($vente + $contribution + $minerval) }}</h5>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
    <canvas id="graphique1" width="200" height="100">
      Ooops !!! votre navigateur n'est pas à jour essayer de chercher les derniers mise à jour
    </canvas>
    </div>
    <div class="col-6">
      <canvas id="graphique2" width="200" height="100">
      Ooops !!! votre navigateur n'est pas à jour essayer de chercher les derniers mise à jour
    </canvas>
    </div>
    <div class="col-4">
      FIRST CHART
    </div>
  </div>
</div>

@push('scripts')
<script type="text/javascript">

  console.log()
  let content = {
    //LISTE DES CLASSE

      labels: @json($classes),
      datasets: [{
        label: "Nombre d'élèves #",
        backgroundColor: [
        '#d14160',
        '#99c93d',
        'rgba(255, 99, 139,0.5)',
        'rgba(25, 99, 12,0.5)',
        'rgba(255, 99, 132,0.5)',
        'rgba(10,80,255,0.5)',
        'rgba(10,80,10,0.5)',
        '#d14160',
        '#99c93d',
        'rgba(255, 99, 139,0.5)',
        'rgba(25, 99, 12,0.5)',
        'rgba(10,80,255,0.5)',
        'rgba(10,80,10,0.5)',
        '#d14160',
        '#99c93d',
        'rgba(255, 99, 139,0.5)',
        'rgba(25, 99, 12,0.5)',
        'rgba(10,80,255,0.5)',
        'rgba(10,80,10,0.5)',
        '#d14160',
        '#99c93d',
        'rgba(255, 99, 139,0.5)',
        'rgba(25, 99, 12,0.5)',
        'rgba(10,80,255,0.5)',
        'rgba(10,80,10,0.5)',
        '#d14160',
        '#99c93d',
        'rgba(255, 99, 139,0.5)',
        'rgba(25, 99, 12,0.5)',
        'rgba(10,80,255,0.5)',
        'rgba(10,80,10,0.5)',
        '#d14160',
        '#99c93d',
        'rgba(255, 99, 139,0.5)',
        'rgba(25, 99, 12,0.5)',
        'rgba(10,80,10,0.5)',
        '#d14160',
        '#99c93d',
        'rgba(255, 99, 139,0.5)',
        'rgba(25, 99, 12,0.5)',

        ],
        borderColor: '#000',
        data: @json($nombre_eleves),
      }]
    };
  var ctx1 = document.getElementById('graphique1').getContext('2d');
  //var ctx2 = document.getElementById('graphique2').getContext('2d');
  var char1 = new Chart(ctx1,{
    type:'bar',
    data:content,
    responsive: true
  })

  var ctx2 = document.getElementById('graphique2').getContext('2d');

  var char2 = new Chart(ctx2,{
    type:'pie',
    data:content,
    responsive: true
  })

</script>
@endpush




