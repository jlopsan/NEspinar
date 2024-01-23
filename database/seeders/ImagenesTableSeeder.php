<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ImagenesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imagenes')->insert([
            'image' => 'prueba.png',
            'producto_id' => '1',
        ]);

        DB::table('imagenes')->insert([
            'image' => 'prueba.png',
            'producto_id' => '2',
        ]);

        DB::table('imagenes')->insert([
            'image' => 'prueba.png',
            'producto_id' => '3',
        ]);
    }
}
