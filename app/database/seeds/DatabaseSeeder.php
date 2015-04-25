<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		DB::table('tbl_oficinas')->insert(array('oficina' => 'Contabilidad'));
      	DB::table('tbl_oficinas')->insert(array('oficina' => 'Recursos Humanos'));
       	DB::table('tbl_oficinas')->insert(array('oficina' => 'Planillas'));
       	DB::table('tbl_oficinas')->insert(array('oficina' => 'Informática'));
       	DB::table('tbl_oficinas')->insert(array('oficina' => 'Compras'));
       	DB::table('tbl_oficinas')->insert(array('oficina' => 'Ventas'));
       	DB::table('tbl_oficinas')->insert(array('oficina' => 'Cuentas por Pagar'));
       	DB::table('tbl_oficinas')->insert(array('oficina' => 'Cuentas por Cobrar'));
	
       	$this->command->info('Oficinas sembradas en la tabla: tbl_oficinas han sido 8.');
		
		DB::table('tbl_roles')->insert(array('rol' => 'Administrador'));
      	DB::table('tbl_roles')->insert(array('rol' => 'Usuario'));
       	
       	$this->command->info('Roles insertados en la tabla: tbl_roles han sido 2.');

       	DB::table('tbl_estados')->insert(array('estado' => 'Desactivado'));
      	DB::table('tbl_estados')->insert(array('estado' => 'Activado'));
      	DB::table('tbl_estados')->insert(array('estado' => 'Eliminado'));
       	
       	$this->command->info('Roles insertados en la tabla: tbl_estados han sido 3.');
    }
	
}