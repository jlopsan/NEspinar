<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'JJ',
                'email' => 'desarrollo@iescelia.dev',
                'password' => '$2y$10$1KD/s0mLyZe/ny7XcdLsteByObFuCV92S/Zh6.5DLqM6agnbgNuM6',
                'type' => 'SuperAdmin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Felix',
                'email' => 'felix@iescelia.com',
                'password' => '$2y$10$.M.giwLhgYkHJHbJAIBlXu2KDAt1GFHal3qA0yTthEyMDBR3SrBWi',
                'type' => 'Admin',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Narciso',
                'email' => 'narciso@narciso.com',
                'password' => '$2y$10$2JRzSNyL2BOd4Fo60rtrPuc79zDsNg/Ol6dO4ZXDfOUxBl71ausLm',
                'type' => 'Basico',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}