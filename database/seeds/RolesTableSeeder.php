<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$roles = [
			['name' => "Administrador"],
			['name' => "Franquisatario"],
			['name' => "Recepcionista"],
			['name' => "Usuario"],
		];

		DB::table('roles')->insert($roles);
	}
}
