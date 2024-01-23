<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class EtiquetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('etiquetas')->insert([
            'name' => 'Paseo de Almería',
        ]);

        DB::table('etiquetas')->insert([
            'name' => 'Rambla de Almería',
        ]);

        DB::table('etiquetas')->insert([
            'name' => 'Alcazaba',
        ]);
        DB::table('etiquetas')->insert([
            'name' => 'Puerto de Almería',
        ]);

        DB::table('etiquetas')->insert([
            'name' => 'Dionisio Godoy',
        ]);
    }
}
