<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;


class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'JJ',
            'email' => 'desarrollo@iescelia.dev',
            'password' => Hash::make('vivaespaña'),
            'type' => 'SuperAdmin'
        ]);

        DB::table('users')->insert([
            'name' => 'Felix',
            'email' => 'felix@iescelia.com',
            'password' => Hash::make('vivaespaña'),
            'type' => 'Admin'
        ]);

        DB::table('users')->insert([
            'name' => 'Narciso',
            'email' => 'narciso@narciso.com',
            'password' => Hash::make('vivaespaña'),
            'type' => 'Basico'
        ]);

    }
}
