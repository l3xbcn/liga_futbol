<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'UsuarioAdmin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin')
        ])->assignRole('Admin');
        User::create([
            'name' => 'UsuarioEdsitor',
            'email' => 'editor@localhost',
            'password' => Hash::make('editor')
        ])->assignRole('Editor');
        User::create([
            'name' => 'UsuarioUno',
            'email' => 'usuariouno@localhost',
            'password' => Hash::make('usuariouno')
        ]);
        User::create([
            'name' => 'UsuarioDos',
            'email' => 'usuariodos@localhost',
            'password' => Hash::make('usuariodos')
        ]);
        User::create([
            'name' => 'UsuarioTres',
            'email' => 'usuariotres@localhost',
            'password' => Hash::make('usuariotres')
        ]);        
        User::create([
            'name' => 'UsuarioCuatro',
            'email' => 'usuariocuatro@localhost',
            'password' => Hash::make('usuariocuatro')
        ]);
        User::create([
            'name' => 'UsuarioCinco',
            'email' => 'usuariocinco@localhost',
            'password' => Hash::make('usuariocinco')
        ]);
        User::create([
            'name' => 'UsuarioSeis',
            'email' => 'usuarioseis@localhost',
            'password' => Hash::make('usuarioseis')
        ]);
        User::create([
            'name' => 'UsuarioSiete',
            'email' => 'usuariosiete@localhost',
            'password' => Hash::make('usuariosiete')
        ]);
        User::create([
            'name' => 'UsuarioOcho',
            'email' => 'usuarioocho@localhost',
            'password' => Hash::make('usuarioocho')
        ]);
        User::create([
            'name' => 'UsuarioNueve',
            'email' => 'usuarionueve@localhost',
            'password' => Hash::make('usuarionueve')
        ]);
        User::create([
            'name' => 'UsuarioDiez',
            'email' => 'usuariodiez@localhost',
            'password' => Hash::make('usuariodiez')
        ]);
        User::create([
            'name' => 'UsuarioOnce',
            'email' => 'usuarioonce@localhost',
            'password' => Hash::make('usuarioonce')
        ]);
        User::create([
            'name' => 'UsuarioDoce',
            'email' => 'usuariodoce@localhost',
            'password' => Hash::make('usuariodoce')
        ]);

    }
}
