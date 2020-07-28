<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$data = array(
        	[
				'nombre'    => 'Administrador',
				'apellidos' => 'Sistemas',
				'direccion' => 'Direccion de Administradores',
				'email'   	=> 'administrador@sysgra.com',
				'password'  => bcrypt('holamundo'),
				'foto'    => 'img/default-user.png',
				'created_at' => new DateTime,
				'updated_at' => new DateTime
        	],
            [
                 'nombre'    => 'anthony',
                'apellidos' => 'cahuin luque',
                'direccion' => 'La victoria',
                'email'     => 'anthony@educatech.com',
                'password'  => bcrypt('holamundo'),
                'foto'    => 'img/default-user.png',
                'created_at' => new DateTime,
                'updated_at' => new DateTime   
            ]
        );
       	App\User::insert($data);
    }
}
