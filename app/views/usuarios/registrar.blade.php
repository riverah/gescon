@section('modulo')
	<div class="row">
		<div class="push_three six columns formulario" >
			
			<div class="encabezado">
				Registrar nuevos usuarios
			</div>
			<div class="contenido">
			{{ Form::open() }}
			<ul>
				<li class="field">
				{{ 
					Form::select('id_oficina', $oficinas, null, array('class' => 'input xxwide') );		
				}}
				</li>
				<li class="field">
				{{ 
					Form::text('nombre' , null , array('placeholder' => 'Ingrese el nombre',
						'class' => 'input xxwide',
						'maxlength' => 30,
						'required' => 'true'));
				}}	
				</li>
				<li class="field">
				{{ 
					Form::text('apellido' , null , array('placeholder' => 'Ingrese el apellido',
						'class' => 'input xxwide',
						'maxlength' => 30,
						'required' => 'true'));
				}}		
				</li>

				<li class="field">
					{{ 
					 Form::email('email' , null , array(
					 	'class' => 'input xxwide',
					 	'maxlength' => 62,
					 	'placeholder' => 'Ingrese el email',
					 	'required' => 'true') )
					}}
				</li>
				<li class="field">
					{{
						Form::password('password', array(
							'class' => 'input xxwide',
							'maxlength' => 16,
							'placeholder' => 'Ingrese el password',
							'required' => 'true'
						));
					}}
				</li>
				<li>
					
					<div class="medium primary btn">
						{{
							Form::submit('Registrate !');
						}}
					</div>
				</li>
			</ul>
			{{ Form::close() }}
			</div>
		</div>
	</div>
@stop