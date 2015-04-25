@section('modulo')
	<div class="row">
		<div class="push_three six columns formulario">
			<div class="encabezado">
				Edición de datos personales del usuario
			</div>
			<div class="contenido">
				{{ Form::open() }}
					<ul>
						<li class="field">
							{{ 
								Form::select('id_oficina', $oficinas, $usuario->id_oficina, array('class' => 'input xxwide') );		
							}}
						</li>
						<li class="field">
						{{ 
							Form::text('nombre' , $usuario->nombre , array('placeholder' => 'Ingrese el nombre',
								'class' => 'input xxwide',
								'maxlength' => 30,
								'required' => 'true'));
						}}	
						</li>
						<li class="field">
						{{ 
							Form::text('apellido' , $usuario->apellido , array('placeholder' => 'Ingrese el apellido',
								'class' => 'input xxwide',
								'maxlength' => 30,
								'required' => 'true'));
						}}		
						</li>
						<div class="medium primary btn">
							{{
								Form::submit('Actualizar datos');
							}}
						</div>
					</ul>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop