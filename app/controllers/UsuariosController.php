<?php  
	class UsuariosController extends BaseController{

		protected $layout = 'layouts.master';
		private $nombre_completo;
		private $email;

		function __construct() {
			$this->beforeFilter('validar', array('only' => array(
				'administrar', 'editar' , 'actualizar' , 'editar_pass'
				)));	
		}

		function registrar(){

			$oficinas = DB::table('tbl_oficinas')->orderBy('oficina')->lists('oficina' , 'id');
			
			$this->layout->notificacion = 'Modulo para registrar nuevos usuarios, ingrese los datos de forma correcta';
			$this->layout->modulo = View::make('usuarios.registrar' , array('oficinas' => $oficinas));
		}

		function registrar_db(){

			$usuarios = new UsuariosModel;

			$usuarios->id_oficina = Input::get('id_oficina');
			$usuarios->id_rol = 2;
			$usuarios->id_status  = 1;
			$usuarios->email  	  = Input::get('email');
			$usuarios->password   = md5(Input::get('password'));
			$usuarios->nombre     = Input::get('nombre');
			$usuarios->apellido   = Input::get('apellido');
			$usuarios->random     = uniqid();

			//Enviar campos a validar
			$data = array(
				'email'		=> Input::get('email'),
				'nombre'	=> Input::get('nombre'),
				'apellido'	=> Input::get('apellido'),
				'password'	=> Input::get('password')
			);

			if(!$usuarios->validador($data)){
				$this->layout->modulo = View::make('mensaje' , array('encabezado' => 'Advertencia:' , 'cuerpo' => $usuarios->mostrar_errores()));
			}
			else{
				
				$usuarios->save();
				$datos_usuario = $usuarios->find($usuarios->id);

				$this->nombre_completo = $datos_usuario->nombre . ' ' .$datos_usuario->apellido;
				$this->email = $datos_usuario->email;

				$data = array(
					'random'	=> $datos_usuario->random
				);

				Mail::send('email', $data, function($message) {
    				
    				$message->to($this->email , $this->nombre_completo)
    				->subject('Bienvenido al sistema de administración de usuarios!');
				});

				$this->layout->notificacion = "Necesita activar su correo electrónico para poder acceder al sistema";
			}	
		}

		function activar($random){
			UsuariosModel::where('random','=',$random)
				->update(array('id_status'=> 2));

			$this->layout->notificacion = "A partir de este momento usted puede acceder al sistema";
		}

		function acceder(){
			$this->layout->notificacion = "Modulo de validación de usuarios";
			$this->layout->modulo = View::make('usuarios.acceder');
		}

			function origen(){
			$this->layout->notificacion = "Bienvenidos a la red gescon";
			$this->layout->modulo = View::make('origen');
		}

		function filosofia(){
			$this->layout->notificacion = "Bienvenidos a la red gescon";
			$this->layout->modulo = View::make('filosofia');
		}

		function mision(){
			$this->layout->notificacion = "Bienvenidos a la red gescon";
			$this->layout->modulo = View::make('mision');
		}

		function vision(){
			$this->layout->notificacion = "Bienvenidos a la red gescon";
			$this->layout->modulo = View::make('vision');
		}

		function valores(){
			$this->layout->notificacion = "Bienvenidos a la red gescon";
			$this->layout->modulo = View::make('valores');
		}

		function como_somos(){
			$this->layout->notificacion = "Bienvenidos a la red gescon";
			$this->layout->modulo = View::make('como_somos');
		}

		function referencia(){
			$this->layout->notificacion = "Bienvenidos a la red gescon";
			$this->layout->modulo = View::make('referencia');
		}





		function validar(){
			$data = Input::all();

			//Reglas de validacion
			$reglas = array(
				'email'    => 'required',
				'password' => 'required|min:8'
			);

			//Mensajes de reglas de validación
			$mensajes = array(
				'email.required'	=> 'La direccion de corre electronico es un campo obligatario',
				'password.min'		=> 'El password debe tener al menos un total de 8 caracteres',
				'password.required' => 'El password es un campo obligatorio'
			);

			//Instanciar el validador
			$validacion = Validator::make($data, $reglas, $mensajes);

			if ($validacion->fails()) {
				$encabezado = "Advertencia: ";
				$mensajes   = $validacion->messages()->all();

				$this->mostrar_mensajes($encabezado, $mensajes);
			}
			else{
				$usuarios = new UsuariosModel;

				$email = Input::get('email');
				$password = Input::get('password');

				$datos_usuario = 
					$usuarios->
					where('email' , '=' ,$email)->
					where('password' , '=' , md5($password))->first();

				if(!$datos_usuario){
					
					$encabezado = "Advertencia:";
					$cuerpo =  'El usuario no se encuentra registrado en la base de datos';

					$this->mostrar_mensajes($encabezado, $cuerpo);
				}
				else{

					if($datos_usuario->id_status == 1){

						$encabezado = "Error!";
						$mensaje = "Necesita activar su cuenta de correo electronico";

						$this->mostrar_mensajes($encabezado, $mensaje);
					}
					else if($datos_usuario->id_status == 3){

						$encabezado = "Error!";
						$mensaje = "El usuario se encuentra eliminado";

						$this->mostrar_mensajes($encabezado, $mensaje);
					}
					else{
						// Crear la session, ID, Rol y nombre completo
						Session::flush();

						Session::put('id_usuario', $datos_usuario->id);
						Session::put('id_rol', $datos_usuario->id_rol);
						Session::put('nombre_completo', $datos_usuario->nombre . ' '.$datos_usuario->apellido);	
						
						return Redirect::to('administrar');
					}
				}
			}
		}

		function administrar(){

			$this->layout->notificacion = "Bienvenido al sistema: " . Session::get('nombre_completo');
			$this->layout->modulo = View::make('usuarios.administrar');
		}

		function salir(){
			Session::flush();

			$this->acceder();
		}
		function mostrar_mensajes($encabezado, $mensajes){
			
			if(!is_array($mensajes)){
				$mensajes = array('mensaje' => $mensajes);	
			}
			
			$this->layout->modulo = View::make('mensaje' , 
				array(
					'encabezado' => $encabezado, 
					'cuerpo' => $mensajes));
		}

		function editar(){
			
			$usuario = DB::table('tbl_usuarios')->where('id' , '=' , Session::get('id_usuario'))->first();
			$oficinas = DB::table('tbl_oficinas')->orderBy('oficina')->lists('oficina' , 'id');

			$this->layout->notificacion	= 'Modulo para editar datos personales';
			$this->layout->modulo = View::make('usuarios.editar', array('oficinas' => $oficinas, 'usuario' => $usuario));
		}

		function actualizar(){
			$id_oficina = Input::get('id_oficina');
			$nombre = Input::get('nombre');
			$apellido = Input::get('apellido');

			DB::table('tbl_usuarios')->where('id', Session::get('id_usuario'))->update(
				array('id_oficina' => $id_oficina, 'nombre' => $nombre, 'apellido' => $apellido)
				);

			return Redirect::to('editar');
		}

		function editar_pass(){
			$this->layout->notificacion = 'Editar password de usuario';
			$this->layout->modulo = View::make('usuarios.editar_pass');
		}

		function actualizar_pass(){

			$usuario = DB::table('tbl_usuarios')->where('id' , '=' , Session::get('id_usuario'))->first();

			if($usuario->password <> md5(Input::get('password_act'))){
				$mensaje = array('El password actual no coincide con lo ingresado');
				$this->mostrar_mensajes('Error en el password' , $mensaje);
			}
			else if(strlen(trim(Input::get('password_nue'))) < 8){
				$mensaje = array('El nuevo password debe tener al menos 8 caracteres de longitud');
				$this->mostrar_mensajes('Error en el password' , $mensaje);
			}
			else{
				DB::table('tbl_usuarios')->where('id', '=' ,Session::get('id_usuario'))->update(
					array('password' => md5(Input::get('password_nue')))
				);

				return Redirect::to('salir');
			}
		}
	}
?>