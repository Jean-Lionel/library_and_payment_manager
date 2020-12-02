<!doctype html>
<html lang="en">
  <head>
  	<title>LYCEE SAINTE-ESPRIT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="{{ asset('style.css')}}">
  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4">
		  		<h1><a href="/" class="logo">LYCEE SAINT  <span>ESPRIT</span></a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="{{ route('sections.index') }}"><span class="fa fa-home mr-3"></span> Section</a>
	          </li>
	          <li>
	              <a href="#"><span class="fa fa-user mr-3"></span> About</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-briefcase mr-3"></span> Works</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-sticky-note mr-3"></span> Blog</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-suitcase mr-3"></span> Gallery</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-cogs mr-3"></span> Services</a>
	          </li>
	          <li>
              <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contacts</a>
	          </li>
	        </ul>


	     

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
       @yield('content')
        
      </div>
		</div>

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>