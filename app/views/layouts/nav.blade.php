<header>
	<div class="container">
		<div class="navbar navbar-default" role="navigation">
      		<div class="navbar-header">
        		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
	            </button>
	            <a class="navbar-brand" href="/" title="Decarlini Maside Arquitectura y Dise&ntilde;o">
	            	<img src="{{ asset('img/decarlini-maside-arquitectos.png') }}" atl="Decarlini Maside Arquitectura y Dise&ntilde;o" class="img-responsive">
	            </a>
      		</div>
			<nav id="menu" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a {{ Request::path() == 'portafolio' ? 'class="active"' : 'href="portafolio" title="Portafolio de trabajos"' }}>Portafolio</a></li>
					<li><a {{ Request::path() == 'servicios' ? 'class="active"' : 'href="servicios" title="Servicios"' }}>Servicios</a></li>
					<li><a {{ Request::path() == 'estudio' ? 'class="active"' : 'href="/estudio" title="Estudio de arquitectos"' }}>Estudio</a></li>
					<li><a {{ Request::path() == 'contacto' ? 'class="active"' : 'href="contacto" title="Env&iacute;enos su consulta"' }}>Contacto</a></li>
				</ul>
			</nav>
        </div>
	</div>
</header>