<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'name' => 'Estación del Ferro-Carril',
            'image' => '01 - LSP 1 Narciso.jpg',
            'categoria_id' => '2',
        ]);

        DB::table('productos')->insert([
            'name' => 'Entrada Real de la Feria',
            'image' => '02 - LSP 2 Juan.jpg',
            'categoria_id' => '2',
        ]);
        DB::table('productos')->insert([
            'name' => 'Plaza de Toros',
            'image' => '03 - LSP 3 Narciso.jpg',
            'categoria_id' => '2',
        ]);
        DB::table('productos')->insert([
            'name' => 'Calle Real',
            'image' => '04 - LSP 4 Juan.jpg',
            'categoria_id' => '2',
        ]);
        DB::table('productos')->insert([
            'name' => 'Cuevas del Puerto',
            'image' => '06 - LSP 6 Juan.jpg',
            'categoria_id' => '2',
        ]);
        DB::table('productos')->insert([
            'name' => 'Vista Panorámica Almería',
            'image' => '07 - LSP 7 Juan.jpg',
            'categoria_id' => '2',
        ]);
        DB::table('productos')->insert([
            'name' => 'Puerto de Almería',
            'image' => '08 - LSP 7 Juan.jpg',
            'categoria_id' => '2',
        ]);
        DB::table('productos')->insert([
            'name' => 'Torre de vela',
            'image' => '09 - LSP 8 Narciso.jpg',
            'categoria_id' => '2',
        ]);
        DB::table('productos')->insert([
            'name' => 'Catedral, Fachada de los Perdones',
            'image' => '10 - LSP 9 Juan.jpg',
            'categoria_id' => '2',
        ]);

        DB::table('productos')->insert([
            'name' => 'Vaso de los Blanquizares de Lébor',
            'image' => 'Vaso de los Blanquizares de Lébor.png',
            'categoria_id' => '1',
        ]);
        
        DB::table('productos')->insert([
            'name' => 'Vaso',
            'image' => 'vaso.png',
            'categoria_id' => '1',
        ]);
        DB::table('productos')->insert([
            'name' => 'Inscripción funeraria',
            'image' => 'Inscripción funeraria.png',
            'categoria_id' => '1',
        ]);
        DB::table('productos')->insert([
            'name' => 'Jarra',
            'image' => 'jarra.png',
            'categoria_id' => '1',
        ]);
        DB::table('productos')->insert([
            'name' => 'Vaso de alabastro',
            'image' => 'vaso de alabastro.png',
            'categoria_id' => '1',
        ]);
        DB::table('productos')->insert([
            'name' => 'Cántaro con galbo de perfil ovoide',
            'image' => 'Cántaro con galbo de perfil ovoide.png',
            'categoria_id' => '1',
        ]);
        DB::table('productos')->insert([
            'name' => 'Aríbalo esférico',
            'image' => 'Aríbalo esférico.png',
            'categoria_id' => '1',
        ]);

    }
}