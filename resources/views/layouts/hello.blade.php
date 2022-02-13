<!DOCTYPE html>

<html>

<head>

    <title>Laravel Livewire Example - ItSolutionStuff.com</title>

    @livewireStyles

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>

    

<div class="container">

    @yield('content')

</div>

    

</body>

  

@livewireScripts

  

<script>

  

window.addEventListener('swal:modal', event => { 

    swal({

      title: event.detail.message,

      text: event.detail.text,

      icon: event.detail.type,

    });

});

  

window.addEventListener('swal:confirm', event => { 

    swal({

      title: event.detail.message,

      text: event.detail.text,

      icon: event.detail.type,

      buttons: true,

      dangerMode: true,

    })

    .then((willDelete) => {

      if (willDelete) {

        window.livewire.emit('remove');

      }

    });

});

 </script>

  

</html>