<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			
			//Referencias externas para las otras tablas

			//Referencia para la tabla de oficinas
			$table->unsignedInteger('id_oficina');
			$table->foreign('id_oficina')->references('id')->on('tbl_oficinas');
			
			//Referencia para la tabla tbl_roles
			$table->unsignedInteger('id_rol');
			$table->foreign('id_rol')->references('id')->on('tbl_roles');
	
			//Referencia para la tabla de estados
			$table->unsignedInteger('id_status');
			$table->foreign('id_status')->references('id')->on('tbl_estados');

			//Fecha y hora de creación
			$table->timestamps();

			//Email
			$table->string('email',62);

			//Password
			$table->string('password',32);

			//Nombre y apellido
			$table->string('nombre', 16);		
			$table->string('apellido', 30);

			//Llave unica
			$table->string('random', 13); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_usuarios');
	}

}