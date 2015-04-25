<?php  
	class UsuariosModel extends Eloquent{

		protected $table = "tbl_usuarios";

		//Establecer las reglas de validación
		private $regla = array(
			'email'   => 'unique:tbl_usuarios|required',
			'nombre'  => 'required|alpha',
			'apellido'=> 'required|alpha',
			'password'=> 'required|min:8'
		);

		//Mensajes de validación
		private $mensajes = array(
			'email.unique'		=> 'La cuenta de correo electronico ya se encuentra registrada',
			'email.required'	=> 'La direccion de corre electronico es un campo obligatario',
			'nombre.alpha' 		=> 'El nombre del usuario debe contener solamente letras',
			'apellido.alpha' 	=> 'El apellido del usuario debe solamente contener letras',
			'nombre.required'	=> 'El nombre es obligatorio',
			'apellido.required' => 'El apellido es obligatorio',
			'password.required' => 'El password es obligatorio',
			'password.min'		=> 'El password debe tener al menos un total de 9 caracteres'
			);

		private $errores;

		function validador($data){
			$validacion = Validator::make($data, $this->regla, $this->mensajes);
			
			if($validacion->fails()){

				$this->errores = $validacion->messages()->all();
				return false;
			}
			else{
				return true;	
			}
		}

		function mostrar_errores(){
			return $this->errores;
		}
	} 
?>