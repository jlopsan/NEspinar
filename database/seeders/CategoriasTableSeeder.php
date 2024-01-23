<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categorias')->insert([
            'name' => 'Piezas Arqueológicas',

        ]);
        DB::table('categorias')->insert([
            'name' => 'Postales de Almería',

        ]);
    }
}