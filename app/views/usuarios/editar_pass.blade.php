@section('modulo')
	<div class="row">
		<div class="push_three six columns formulario">
			<div class="encabezado">
				Editar Password
			</div>
			<div class="contenido">
			{{ Form::open() }}
				<ul>
					<li class="field">
					{{
						Form::password('password_act', array(
							'class' => 'input xxwide',
							'maxlength' => 16,
							'placeholder' => 'Ingrese su password actual',
							'required' => 'true'
						));
					}}
					</li>
					<li class="field">
					{{
						Form::password('password_nue', array(
							'class' => 'input xxwide',
							'maxlength' => 16,
							'placeholder' => 'Ingrese el nuevo password',
							'required' => 'true'
						));
					}}
					</li>
					<li>
						<div class="medium primary btn">
							{{ Form::submit('Actualizar') }}
						</div>
					</li>
				</ul>	
			{{ Form::close() }}
			</div>
		</div>
	</div>
@stop