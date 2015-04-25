<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>ADMIN USERS</title>

	{{ HTML::style('css/gumby.css'); }}
	{{ HTML::style('css/main.css'); }}

	{{ HTML::script('js/jquery.min.js'); }}

	{{ HTML::script('js/modernizr-2.6.2.min.js'); }}
	{{ HTML::script('js/gumby.js'); }}
	{{ HTML::script('js/gumby.toggleswitch.js'); }}
	{{ HTML::script('js/gumby.init.js'); }}
	{{ HTML::script('js/plugins.js'); }}

</head>
<body>
	<div class="navbar" id="navegacion">
		
		<div class="items_navegacion">

			<a class="toggle" gumby-trigger="#navegacion > .items_navegacion > ul" href="#">
	        		<i class="icon-menu"></i>
	      	</a>

				@if(Session::get('id_usuario'))
				<h5 id="usuario" class="logo">
					Usuario conectado: {{ Session::get('nombre_completo') }}
				</h5>
				@endif

			<ul style="float:right">
				
				@if(!Session::get('id_usuario'))
				<!-- Menu para acceder al sistema -->
				<li>
					<a href="{{ url('origen') }}">
						<span>Origen</span>
						
					</a>
				</li>
				<!-- Menu para registrar nuevos usuarios -->
				<li>
					<a href="{{ url('filosofia') }}">
						<span>filosofia</span>
						
	          		</a>
				</li>
					<!-- Menu para registrar nuevos usuarios -->
				<li>
					<a href="{{ url('mision') }}">
						<span>Misión</span>
						
	          		</a>
				</li>
				<!-- Menu para registrar nuevos usuarios -->
				<li>
					<a href="{{ url('vision') }}">
						<span>Visión</span>
						
	          		</a>
				</li>
				<!-- Menu para registrar nuevos usuarios -->
				<li>
					<a href="{{ url('/como_somos') }}">
						<span>Como somos</span>
						
	          		</a>
				</li>
				<!-- Menu para registrar nuevos usuarios -->
				<li>
					<a href="{{ url('registrar') }}">
						<span>Marco de referencia</span>
						
	          		</a>
				</li>
				@else
					<li>
						<a href="{{ url('/editar_pass') }}">
							<span>Editar pass</span>
							<i class="icon-key"></i>
						</a>
					</li>
					<li>
						<a href="{{ url('/editar') }}">
							<span>
								Editar
							</span>
							<i class="icon-pencil"></i>
						</a>	
					</li>
					
					<!-- Menu para salir -->
					<li>
						<a href="{{ url('/salir') }}">
							<span>
								Salir 
							</span>
							<i class="icon-cancel"></i>
						</a>
					</li>
				@endif
			</ul>
		</div>
	</div>

	<div class="notificaciones">
		<div class="row">
			<div class="twelve columns">
				{{ @$notificacion }}
			</div>
		</div>
	</div>
	
	@yield('origen')
</body>
</html>