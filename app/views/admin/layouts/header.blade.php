<header>
  <div class="container">
		<nav class="navbar navbar-default" role="navigation">
  			<div class="navbar-header">
    			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			      <span class="sr-only">Desplegar navegación</span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
			      <span class="icon-bar"></span>
    			</button>
    			<a class="navbar-brand" href="{{ asset('admin') }}" title="Panel de administraci&oacute;n">
            <img src="{{ asset('img/decarlini-maside-arquitectos.png') }}" alt="Decarlini Maside" class="img-responsive" />  
          </a>
  			</div>
	 	 	<div class="collapse navbar-collapse navbar-ex1-collapse">
    			<ul class="nav navbar-nav">
              <li><a {{ Request::path() == 'admin' ? 'class="active"' : 'href="'.asset("admin").'" title="Proyectos"' }}>Proyectos</a></li>
              <li class="usuario"><a title="Configuraci&oacute;n de usuario" href="{{ asset('admin/configuracion') }}">{{ Auth::user()->name }}</a></li>
              <li class="icono-nav"><a href="{{ asset('cerrarSesion') }}" title="Cerrar sesi&oacute;n"><span class="glyphicon glyphicon-off"></span></a></li>
    			</ul>
  			</div>
		</nav>
	</div>
</header>